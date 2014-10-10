<?php

namespace Topxia\Service\User\Dao;

interface StatusDao
{
    public function getStatus($id);

    public function findStatusesByUserIds($userIds, $start, $limit);

    public function findStatusesByUserIdsCount($userIds);

    public function findStatusesByUserId($userId,$startTime=null,$endTime=null);

    public function findStatusesByUserIdCount($userId,$startTime=null,$endTime=null);
    
    public function searchStatusesCount($conditions);

    public function searchStatuses($conditions, $sort, $start, $limit);

    public function addStatus($status);

    public function updateStatus($id, $fields);

    public function deleteStatus($id);
}