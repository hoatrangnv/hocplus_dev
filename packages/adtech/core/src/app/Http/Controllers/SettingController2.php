<?php

namespace Adtech\Core\App\Http\Controllers;

use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Adtech\Core\App\Repositories\SettingRepository;
use Adtech\Core\App\Models\Setting;
use Adtech\Core\App\Models\Locale;
use Validator;
use Cache;
use Auth;

class SettingController extends Controller
{
    /**
     * @var Filesystem
     */
    protected $files;

    private $messages = array(
        'name.regex' => "Sai định dạng",
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số"
    );

    public function __construct(SettingRepository $settingRepository, Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
        $this->setting = $settingRepository;
    }

    public function manage(Request $request)
    {
        $request->session()->put('website_language', 'en');
        $arrTranslate = [];
        $tab = $request->input('tab', 0);
        $tab_tran = $request->input('tab_tran', '');

        $language = config('app.fallback_locale');
        $moduleList = config('site.modules');
        if (count($moduleList) > 0) {
            foreach ($moduleList as $package => $modules) {

                if (count($modules) > 0) {
                    foreach ($modules as $module) {

                        $directory = 'packages/' . $package . '/' . $module . '/src/translations/' . $language;
                        if ($this->files->isDirectory('../' . $directory)) {

                            $packagesDir = base_path() . '/' . $directory;
                            $ls = @scandir($packagesDir);
                            if ($ls) {
                                foreach ($ls as $index => $file) {
                                    if ($file === '.' || $file === '..') {
                                        continue;
                                    }

                                    //
                                    $fileTranslate = $packagesDir . '/' . $file;
                                    $arrTranslate[$package . '-' . $module][$file] = include $fileTranslate;
                                    //
                                }
                            }
                        }
                    }
                }
            }
        }

//        $languageArr = config('translatable.locales');
        $languageArr = Locale::where('status', 1)->get();
        $settings = Setting::where('domain_id', $this->domainDefault)->get();
        $title = $logo = $logo_mini = $logo_link = $favicon = $company_name = $address = $email = $phone = $hotline = $ga_code = $chat_code = $slogan = $app_version = $info_page_contact = $info_footer_1 = $info_footer_2 = $info_footer_3 = '';

        if (count($settings) > 0) {
            foreach ($settings as $setting) {
                switch ($setting->name) {
                    case 'logo':
                        $logo = $setting->value;
                        break;
                    case 'app_version':
                        $app_version = $setting->value;
                        break;
                    case 'logo_mini':
                        $logo_mini = $setting->value;
                        break;
                    case 'title':
                        $title = $setting->value;
                        break;
                    case 'favicon':
                        $favicon = $setting->value;
                        break;
                    case 'logo_link':
                        $logo_link = $setting->value;
                        break;
                    case 'company_name':
                        $company_name = $setting->value;
                        break;
                    case 'address':
                        $address = $setting->value;
                        break;
                    case 'email':
                        $email = $setting->value;
                        break;
                    case 'phone':
                        $phone = $setting->value;
                        break;
                    case 'hotline':
                        $hotline = $setting->value;
                        break;
                    case 'ga_code':
                        $ga_code = $setting->value;
                        break;
                    case 'chat_code':
                        $chat_code = $setting->value;
                        break;
                    case 'slogan':
                        $slogan = $setting->value;
                        break;
                    case 'info_page_contact':
                        $info_page_contact = $setting->value;
                        break;
                    case 'info_footer_1':
                        $info_footer_1 = $setting->value;
                        break;
                    case 'info_footer_2':
                        $info_footer_2 = $setting->value;
                        break;
                    case 'info_footer_3':
                        $info_footer_3 = $setting->value;
                        break;
                }
            }
        }

        $data = [
            'arrTranslate' => $arrTranslate,
            'languageCurrent' => $language,
            'languages' => $languageArr,
            'tab_tran' => $tab_tran,
            'title' => $title,
            'tab' => $tab,
            'logo' => $logo,
            'app_version' => $app_version,
            'company_name' => $company_name,
            'logo_mini' => $logo_mini,
            'logo_link' => $logo_link,
            'favicon' => $favicon,
            'address' => $address,
            'email' => $email,
            'phone' => $phone,
            'hotline' => $hotline,
            'ga_code' => $ga_code,
            'chat_code' => $chat_code,
            'slogan' => $slogan,
            'info_page_contact' => $info_page_contact,
            'info_footer_1' => $info_footer_1,
            'info_footer_2' => $info_footer_2,
            'info_footer_3' => $info_footer_3
        ];
        return view('ADTECH-CORE::modules.core.setting.manage', $data);
    }

    public function translate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_module' => 'required',
            'file' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {

            $package_module = $request->input('package_module');
            $file = $request->input('file');
            $language = config('app.locale');

            $directory = 'packages/' . str_replace('-', '/', $package_module) . '/src/translations/' . $language;
            if ($this->files->isDirectory('../' . $directory)) {
                $packagesDir = base_path() . '/' . $directory . '/' . $file;
//                $tranFile = file_get_contents($packagesDir);
                $tranList = $request->input('tran');

//                $stubFile = '../packages/adtech/application/src/resources/stubs/translation_default.stub';
                $this->files->put($packagesDir, '<?php return ' . var_export($tranList, true) .';');
                return redirect()->route('adtech.core.setting.manage', ['tab' => 1, 'tab_tran' => $package_module])->with('success', trans('adtech-core::messages.success.create'));
            }

        } else {
            return $validator->messages();
        }

//        $composerFile = file_get_contents($path);
//        file_put_contents($path, str_replace('__', '-', str_replace('\/', '/', json_encode($composerObject))));
    }

    public function update(Request $request)
    {
        $inputs = $request->all();
        if (count($inputs) > 0) {
            foreach ($inputs as $k => $input) {
                if ($k != '_method' && $k != '_token') {

                    //kiem tra input la file hay text
                    if ($request->hasFile($k)) {
                        //
                    } else {
                        $setting = $this->setting->findBy('name', $k);
                        if (null == $setting) {
                            $setting = new Setting();
                            $setting->domain_id = $this->domainDefault;
                            $setting->name = $k;
                        }
                        $setting->value = (empty($input) && $input != 0) ? '' : $input;
                        $setting->domain_id = $this->domainDefault;
                        $setting->save();
                    }

                }
            }



            Cache::forget('settings' . $this->domainDefault);
            Cache::forget('data_api_settings_versions_' . $this->domainDefault);
            Cache::forget('data_api_settings_config_text_' . $this->domainDefault);
            return redirect()->route('adtech.core.setting.manage')->with('success', trans('adtech-core::messages.success.create'));
        }
    }

    public function setLanguage(Request $request) {
        $request->session()->put('website_language', $request->input('language'));
        return back();
    }

    public function memcached() {
        $encrypted = '';
        return view('ADTECH-CORE::modules.core.setting.memcached', compact('encrypted'));
    }

    public function resetCache(Request $request) {
        if ($request->has('cache_name')) {
            if ($request->input('cache_name') == 'all') {
                Cache::flush();
                return redirect()->route('adtech.core.setting.memcached')->with('success', trans('adtech-core::messages.success.create'));
            }
            if (Cache::has($request->input('cache_name'))) {
                Cache::forget($request->input('cache_name'));
                return redirect()->route('adtech.core.setting.memcached')->with('success', trans('adtech-core::messages.success.create'));
            } else {
                $encrypted = $this->my_simple_crypt( $request->input('cache_name') . 'time='.time()*1000, 'e' );
                return view('ADTECH-CORE::modules.core.setting.memcached', compact('encrypted'));
            }
        }
        return redirect()->route('adtech.core.setting.memcached')->with('error', trans('adtech-core::messages.error.create'));
    }
}
