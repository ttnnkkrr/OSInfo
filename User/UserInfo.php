<?php
class UserInfo {
    /**
     * @var null
     */
    private $user                       = null;
    /**
     * @var null
     */
    private $userName                   = null;
    /**
     * @var null
     */
    private $group                      = null;
    /**
     * @var null
     */
    private $groupName                  = null;
    /**
     * @var bool
     */
    private $sudo                       = false;

    /**
     * @param $uid
     * @param $uid
     * @return bool
     */
    static function inGroup($uid, $uid){
        return (bool) in_array(posix_getpwuid((int) $uid)['name'], posix_getgrgid ( $uid )['members']);
    }

    /**
     * @return $this
     */
    static function currentProcessUser(){
        return (new UserInfo())->setUser(posix_getuid());
    }

    /**
     * @return null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param null $user
     */
    public function setUser($user)
    {
        $this->user = (int) $user;
        $this->setUserName($user);
        $this->setGroup(posix_getgrgid(posix_getpwuid($user)['gid']));
        $this->setSudo();
        return $this;
    }

    /**
     * @return null
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param null $userName
     */
    private function setUserName($uid)
    {
        $this->userName = posix_getpwuid((int) $uid)['name'];
    }

    /**
     * @return null
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param null $group
     */
    private function setGroup($group)
    {
        $this->group = $group['gid'];
        $this->setGroupName($group['name']);
    }

    /**
     * @return null
     */
    public function getGroupName()
    {
        return $this->groupName;
    }

    /**
     * @param null $groupName
     */
    private function setGroupName($groupName)
    {
        $this->groupName = $groupName;
    }

    /**
     * @return boolean
     */
    public function isSudo()
    {
        return (bool) in_array($this->getUserName(), posix_getgrgid ( 0 )['members']);
    }

    /**
     * @param boolean $sudo
     */
    private function setSudo()
    {
        $this->sudo = $this->isSudo();
    }



}
