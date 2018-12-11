<?php

namespace ApiBundle\Api\Resource\Page;

use ApiBundle\Api\ApiRequest;
use ApiBundle\Api\Annotation\ApiConf;
use ApiBundle\Api\Resource\AbstractResource;
use Biz\User\UserException;
use ApiBundle\Api\Annotation\Access;
use ApiBundle\Api\Resource\Classroom\ClassroomFilter;
use ApiBundle\Api\Resource\Course\CourseFilter;
use ApiBundle\Api\Resource\Coupon\CouponFilter;
use ApiBundle\Api\Resource\Filter;

class PageSetting extends AbstractResource
{
    /**
     * @ApiConf(isRequiredAuth=false)
     */
    public function get(ApiRequest $request, $portal, $type)
    {
        $mode = $request->query->get('mode', 'published');

        if (!in_array($mode, array('draft', 'published'))) {
            throw PageException::ERROR_MODE();
        }
        $type = 'course' == $type ? 'courseCondition' : $type;
        if (!in_array($type, array('courseCondition', 'discovery'))) {
            throw PageException::ERROR_TYPE();
        }

        if (!in_array($portal, array('h5', 'miniprogram'))) {
            throw PageException::ERROR_PORTAL();
        }
        $method = 'get'.ucfirst($type);

        return $this->$method($portal, $mode);
    }

    /**
     * @Access(roles="ROLE_ADMIN,ROLE_SUPER_ADMIN")
     */
    public function add(ApiRequest $request, $portal)
    {
        $mode = $request->query->get('mode');
        if (!in_array($mode, array('draft', 'published'))) {
            throw PageException::ERROR_MODE();
        }
        $type = $request->query->get('type');
        if (!in_array($type, array('discovery'))) {
            throw PageException::ERROR_TYPE();
        }

        if (!in_array($portal, array('h5', 'miniprogram'))) {
            throw PageException::ERROR_PORTAL();
        }
        $content = $request->request->all();
        $method = 'add'.ucfirst($type);

        return $this->$method($portal, $mode, $content);
    }

    /**
     * @Access(roles="ROLE_ADMIN,ROLE_SUPER_ADMIN")
     */
    public function remove(ApiRequest $request, $portal, $type)
    {
        $mode = $request->query->get('mode');
        if ('draft' != $mode) {
            throw PageException::ERROR_MODE();
        }
        if (!in_array($type, array('discovery'))) {
            throw PageException::ERROR_TYPE();
        }

        if (!in_array($portal, array('h5', 'miniprogram'))) {
            throw PageException::ERROR_PORTAL();
        }
        $method = 'remove'.ucfirst($type);

        return $this->$method($portal, $mode);
    }

    protected function addDiscovery($portal, $mode = 'draft', $content = array())
    {
        $this->getSettingService()->set("{$portal}_{$mode}_discovery", $content);

        return $this->getDiscovery($portal, $mode);
    }

    protected function removeDiscovery($portal, $mode = 'draft')
    {
        $this->getSettingService()->delete("{$portal}_{$mode}_discovery");

        return array('success' => true);
    }

    protected function getDiscovery($portal, $mode = 'published')
    {
        $user = $this->getCurrentUser();
        if ('draft' == $mode && !$user->isAdmin()) {
            throw UserException::PERMISSION_DENIED();
        }
        $discoverySettings = $this->getH5SettingService()->getDiscovery($portal, $mode, 'setting');
        foreach ($discoverySettings as &$discoverySetting) {
            if ('course_list' == $discoverySetting['type'] && 'condition' == $discoverySetting['data']['sourceType']) {
                $this->getOCUtil()->multiple($discoverySetting['data']['items'], array('creator', 'teacherIds'));
                $this->getOCUtil()->multiple($discoverySetting['data']['items'], array('courseSetId'), 'courseSet');
                $courseFilter = new CourseFilter();
                $courseFilter->setMode(Filter::PUBLIC_MODE);
                foreach ($discoverySetting['data']['items'] as &$course) {
                    $courseFilter->filter($course);
                }
            }
            if ('classroom_list' == $discoverySetting['type'] && 'condition' == $discoverySetting['data']['sourceType']) {
                $this->getOCUtil()->multiple($discoverySetting['data']['items'], array('creator', 'teacherIds', 'assistantIds', 'headTeacherId'));
                $classroomFilter = new ClassroomFilter();
                $classroomFilter->setMode(Filter::PUBLIC_MODE);
                foreach ($discoverySetting['data']['items'] as &$classroom) {
                    $classroomFilter->filter($classroom);
                }
            }

            if ('coupon' == $discoverySetting['type']) {
                $couponFilter = new CouponFilter();
                $couponFilter->setMode(Filter::PUBLIC_MODE);
                foreach ($data['type']['data'] as $couponBatch) {
                    if (!empty($couponBatch['currentUserCoupon'])) {
                        $couponFilter->filter($couponBatch['currentUserCoupon']);
                    }
                }
            }
        }

        return $discoverySettings;
    }

    protected function getCourseCondition($portal, $mode = 'published')
    {
        return $this->getH5SettingService()->getCourseCondition($portal, $mode);
    }

    protected function getSettingService()
    {
        return $this->service('System:SettingService');
    }

    protected function getH5SettingService()
    {
        return $this->service('System:H5SettingService');
    }
}
