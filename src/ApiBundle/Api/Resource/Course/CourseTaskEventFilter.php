<?php

namespace ApiBundle\Api\Resource\Course;

use ApiBundle\Api\Resource\Filter;

class CourseTaskEventFilter extends Filter
{
    protected $publicFields = array(
        'result', 'event', 'nextTask', 'completionRate'
    );

    protected function publicFields(&$data)
    {
        $taskResultFilter = new CourseTaskResultFilter();
        $taskResultFilter->filter($data['result']);

        $taskFilter = new CourseTaskFilter();
        $taskFilter->setMode(Filter::SIMPLE_MODE);
        $taskFilter->filter($data['nextTask']);
    }
}