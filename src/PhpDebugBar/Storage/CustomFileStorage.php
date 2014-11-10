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
    protected $collectorToSave = array();

    /**
     * getter
     * @return array
     */
    public function getCollectorToSave(){
        return $this->collectorToSave;
    }

    /**
     * setter
     * @param array $collectorToSave
     */
    public function setCollectorToSave($collectorToSave){
        $this->collectorToSave = $collectorToSave;
        return $this;
    }

    /**
     * ajoute le nom du collector à sauver
     * @param array $collectorToSave
     */
    public function addCollectorToSave($collectorToSave){
        $this->collectorToSave[] = $collectorToSave;
        return $this;
    }

    /**
     * overide methode save
     * @param $id
     * @param $data
     */
    public function save($id, $data)
    {
        var_dump($data);
        $d=array();
        foreach($data as $key=>$value){
            if(in_array($key,$this->collectorToSave)){
                $d[$key] = $value;
            }
        }
        parent::save($id, $d);
    }

}
