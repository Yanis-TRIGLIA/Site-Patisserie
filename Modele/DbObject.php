<?php

/**
 * Abstract object to gather models common features
 */
abstract class DbObject {

    private $id;
    private $name;

    /**
     * Constructor
     * @param int $id
     * @param string $name
     */
    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Id getter
     * @return int
     */
    public final function getId() {
        return $this->id;
    }

    /**
     * Id setter
     * @param int $id
     * @return void
     */
    public final function setId($id) {
        $this->id = $id;
    }

    /**
     * Name getter
     * @return string
     */
    public final function getName() {
        return $this->name;
    }

    /**
     * Name setter
     * @param string $name
     * @return void
     */
    public final function setName($name) {
        $this->name = $name;
    }

    // Database interactions

    /**
     * Insert **this** Object in the database
     * It also set **this** id to the given auto-incremented id in database
     * @return void
     */
    public abstract function insert();

    /**
     * Put **this** Object attributes in database
     * @return void
     */
    public abstract function update();

    /**
     * Put database attributes in **this** Object
     * @return void
     */
    public abstract function refresh();

    /**
     * Delete **this** Object in the database
     * @return void
     */
    public abstract function delete();

    public function __toString() {
        return __CLASS__ . '{' .
            'id=' . $this->getId() .
            ', name=' . $this->getName() .
            '}';
    }

}