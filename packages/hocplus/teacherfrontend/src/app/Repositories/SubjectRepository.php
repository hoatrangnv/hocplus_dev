<?php

namespace Hocplus\Teacherfrontend\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;

class SubjectRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Hocplus\Teacherfrontend\App\Models\Subject';
    }

    public function findAll() {
        $result = $this->model
            ->select('subject_id', 'name')
            ->get();
        return $result;
    }
}
