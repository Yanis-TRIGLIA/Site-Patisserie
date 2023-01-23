<?php

/**
 * Manager to easily prepare and execute sql requests
 */
final class RequestsManager {

    private $requests = [];

    public function __construct($table) {
        $this->add('*', 'SELECT * FROM ' . $table);
        $this->add('by_id', 'SELECT * FROM ' . $table . ' WHERE ID_' . $table . '=?');
    }

    /**
     * Prepare a new sql request stored under an alias
     * @param mixed $name The alias to store the request
     * @param string $req The sql request to prepare
     * @return void
     */
    public function add($name, $req) {
        $this->requests[$name] = modele::$pdo->prepare($req);
    }

    /**
     * Execute the prepared request and return the result set
     * @param string $name The alias of the stored request
     * @param array $params Arguments for the execution
     * @return PDOStatement
     */
    public function execute($name, $params = null) {
        $this->requests[$name]->execute($params);
        return $this->requests[$name];
    }

}