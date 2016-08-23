<?php
/**
 * Class LinuxOSInfo
 */
class LinuxOSInfo
{

    /**
     * @var
     */
    private $distrib_id; //Ubuntu

    /**
     * @var
     */
    private $distrib_release; //14.04

    /**
     * @var
     */
    private $distrib_codename; //trusty

    /**
     * @var
     */
    private $distrib_description; //Ubuntu 14.04.5 LTS

    /**
     * @var
     */
    private $name; //Ubuntu

    /**
     * @var
     */
    private $version; //14.04.5 LTS, Trusty Tahr

    /**
     * @var
     */
    private $id; //ubuntu

    /**
     * @var
     */
    private $id_like; //debian

    /**
     * @var
     */
    private $pretty_name; //Ubuntu 14.04.5 LTS

    /**
     * @var
     */
    private $version_id; //14.04

    /**
     * @var
     */
    private $home_url; //http://www.ubuntu.com/

    /**
     * @var
     */
    private $support_url; //http://help.ubuntu.com/

    /**
     * @var
     */
    private $bug_report_url;

    /**
     * LinuxOSInfo constructor.
     */
    public function __construct()
    {
        if (PHP_OS === 'Linux') {
            try {
                $files = glob('/etc/*-release');
                foreach ($files as $file) {
                    $lines = array_filter(array_map(function ($line) {

                        // split value from key
                        $parts = explode('=', $line);

                        // makes sure that "useless" lines are ignored (together with array_filter)
                        if (count($parts) !== 2) return false;

                        // remove quotes, if the value is quoted
                        $parts[1] = str_replace(array('"', "'"), '', $parts[1]);
                        return $parts;

                    }, file($file)));
                    foreach ($lines as $line) {
                        $this->__set($line[0], $line[1]);
                    }
                }
            } catch (Exception $e) {
                die('This script only works on Linux Distros');
            }
        } else {
            die('This script only works on Linux Distros, Not ' . PHP_OS);
        }

    }

    /**
     * @param $name
     * @param $value
     */
    private function __set($name, $value)
    {
        $prop = strtolower($name);
        if (property_exists($this, $prop))
            $this->{$prop} = $value;
    }

    /**
     * @return mixed
     */
    public function getDistribId()
    {
        return $this->distrib_id;
    }

    /**
     * @return mixed
     */
    public function getDistribRelease()
    {
        return $this->distrib_release;
    }

    /**
     * @return mixed
     */
    public function getDistribCodename()
    {
        return $this->distrib_codename;
    }

    /**
     * @return mixed
     */
    public function getDistribDescription()
    {
        return $this->distrib_description;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIdLike()
    {
        return $this->id_like;
    }

    /**
     * @return mixed
     */
    public function getPrettyName()
    {
        return $this->pretty_name;
    }

    /**
     * @return mixed
     */
    public function getVersionId()
    {
        return $this->version_id;
    }

    /**
     * @return mixed
     */
    public function getHomeUrl()
    {
        return $this->home_url;
    }

    /**
     * @return mixed
     */
    public function getSupportUrl()
    {
        return $this->support_url;
    }

    /**
     * @return mixed
     */
    public function getBugReportUrl()
    {
        return $this->bug_report_url;
    }

}
