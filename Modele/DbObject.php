<?php

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
    public function getId() {
        return $this->id;
    }

    /**
     * Name getter
     * @return string
     */
    public function getName() {
        return $this->name;
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

}