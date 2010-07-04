<?php

namespace F3\Admin\Core;

/*                                                                        *
 * This script belongs to the FLOW3 package "Fluid".                      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * @version $Id: ForViewHelper.php 3346 2009-10-22 17:26:10Z k-fish $
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 * @api
 * @scope prototype
 */
class Being{
    /**
	 * @var \F3\FLOW3\Object\ObjectManagerInterface
	 * @api
	 * @author Marc Neuhaus <apocalip@gmail.com>
	 * @inject
	 */
	protected $objectManager;

    protected $id = null;
    protected $object;
    protected $class;
    protected $adapter;
    protected $name;
    protected $properties;
    protected $errors = array();
    protected $sets;
    protected $views;
    protected $selected = false;
    protected $prefix = "item";

    public function __construct($adapter){
        $this->adapter = $adapter;
    }

    public function __toString(){
        if(is_object($this->object) && is_callable(array($this->object,"__toString")))
            return strval($this->object->__toString());
        return "";
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getClass() {
        return $this->class;
    }

    public function setClass($class) {
        $this->name = $this->adapter->getName($class);
        $this->class = $class;
    }

    public function getAdapter() {
        return $this->adapter;
    }

    public function setAdapter($adapter) {
        $this->adapter = $adapter;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getProperties() {
        return $this->properties;
    }

    public function setProperties($properties) {
        foreach($properties as $property){
            $property->setParent($this);
        }
        $this->properties = $properties;
    }

    public function getSets(){
        $sets = array();
        foreach($this->sets as $name => $set){
            foreach($set as $property){
                $sets[$name][$property] = $this->properties[$property];
            }
        }
        return $sets;
    }

    public function _getSets() {
        return $this->sets;
    }

    public function setSets($sets) {
        $this->sets = $sets;
    }

    public function getViews() {
        return $this->views;
    }

    public function setViews($views) {
        $this->views = $views;
    }

    public function getObject() {
        return $this->object;
    }

    public function setObject($object) {
        $this->object = $object;
    }

    public function getValue($property){
        return $this->adapter->getValue($property,$this->object);
    }

    public function getSelected() {
        return $this->selected;
    }

    public function setSelected($selected) {
        $this->selected = $selected;
    }

    public function getPrefix() {
        return $this->prefix;
    }

    public function setPrefix($prefix) {
        $this->prefix = $prefix;
    }

    public function getErrors($property = null) {
        if($property == null)
            return $this->errors;
        else
            return isset($this->errors[$property]) ? $this->errors[$property] : array();
    }

    public function setErrors($errors) {
        $this->errors = $errors;
    }
}

?>