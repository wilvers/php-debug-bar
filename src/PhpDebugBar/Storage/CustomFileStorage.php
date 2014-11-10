<?php
/*
 * This file is part of the DebugBar package.
 *
 * (c) 2013 Maxime Bouroumeau-Fuseau
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhpDebugBar\Storage;
use DebugBar\Storage\FileStorage;

/**
 * Stores collected data into files
 */
class CustomFileStorage extends FileStorage
{
    //array with collector to save
    protected $collectorsToSave = array();

    /**
     * getter
     * @return array
     */
    public function getCollectorsToSave(){
        return $this->collectorsToSave;
    }

    /**
     * setter
     * @param array $collectorToSave
     */
    public function setCollectorsToSave($collectorsToSave){
        $this->collectorsToSave = $collectorsToSave;
        return $this;
    }

    /**
     * ajoute le nom du collector à sauver
     * @param array $collectorToSave
     */
    public function addCollectorToSave($collectorToSave){
        $this->collectorsToSave[] = $collectorToSave;
        return $this;
    }

    /**
     * overide methode save
     * @param $id
     * @param $data
     */
    public function save($id, $data)
    {
        $d=array();
        foreach($data as $key=>$value){
            if(in_array($key,$this->collectorsToSave)){
                $d[$key] = $value;
            }
        }
        var_dump($d);
        parent::save($id, $d);
    }

}
