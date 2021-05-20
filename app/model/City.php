<?php
require_once 'model/Model.php';

class City extends Model {

    public function getCities() {
        $sql = "SELECT * FROM cities";
        $cities = $this->executerequest($sql);
        $cities = $cities->fetchAll();
        return $cities;
    }

    public function getCityIdByName($city_name) {
        $sql = 'SELECT city_id FROM cities WHERE city_name = ?';
        $city_id = $this->executeRequest($sql, [$city_name]);
        $city_id = $city_id->fetch();
        return $city_id['city_id'];
    }
}