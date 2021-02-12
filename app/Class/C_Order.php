<?php

namespace App\Class;

use PDO;
// use Exception;
// use Biblioteca\Services\DatabaseService;
// use Biblioteca\Services\SessionService;

class C_Order {
    private $id;
    private $delivery_date;
    private $delivery_time;
    private $delivery_address;
    private $total_order;
    private $total_comission;
    private $observation;
    private $status_comission;
    private $sector_cod;
    private $city_sale_cod;
    private $client_id;
    private $collaborator_id;
    private $order_status_cod;
    private $created_at;
    private $updated_at;
  
  

    

function __construct($id, $delivery_date, $delivery_time, $delivery_address, $total_order, $total_comission, $observation, $status_comission, $sector_cod, $city_sale_cod, $client_id, $collaborator_id, $order_status_cod, $created_at, $updated_at) {
    $this->id = $id;
    $this->delivery_date = $delivery_date;
    $this->delivery_time = $delivery_time;
    $this->delivery_address = $delivery_address;
    $this->total_order = $total_order;
    $this->total_comission = $total_comission;
    $this->observation = $observation;
    $this->status_comission = $status_comission;
    $this->sector_cod = $sector_cod;
    $this->city_sale_cod = $city_sale_cod;
    $this->client_id = $client_id;
    $this->collaborator_id = $collaborator_id;
    $this->order_status_cod = $order_status_cod;
    $this->created_at = $created_at;
    $this->updated_at = $updated_at;
}

function getId() {
    return $this->id;
}

function getDelivery_date() {
    return $this->delivery_date;
}

function getDelivery_time() {
    return $this->delivery_time;
}

function getDelivery_address() {
    return $this->delivery_address;
}

function getTotal_order() {
    return $this->total_order;
}

function getTotal_comission() {
    return $this->total_comission;
}

function getObservation() {
    return $this->observation;
}

function getStatus_comission() {
    return $this->status_comission;
}

function getSector_cod() {
    return $this->sector_cod;
}

function getCity_sale_cod() {
    return $this->city_sale_cod;
}

function getClient_id() {
    return $this->client_id;
}

function getCollaborator_id() {
    return $this->collaborator_id;
}

function getOrder_status_cod() {
    return $this->order_status_cod;
}

function getCreated_at() {
    return $this->created_at;
}

function getUpdated_at() {
    return $this->updated_at;
}

function setId($id): void {
    $this->id = $id;
}

function setDelivery_date($delivery_date): void {
    $this->delivery_date = $delivery_date;
}

function setDelivery_time($delivery_time): void {
    $this->delivery_time = $delivery_time;
}

function setDelivery_address($delivery_address): void {
    $this->delivery_address = $delivery_address;
}

function setTotal_order($total_order): void {
    $this->total_order = $total_order;
}

function setTotal_comission($total_comission): void {
    $this->total_comission = $total_comission;
}

function setObservation($observation): void {
    $this->observation = $observation;
}

function setStatus_comission($status_comission): void {
    $this->status_comission = $status_comission;
}

function setSector_cod($sector_cod): void {
    $this->sector_cod = $sector_cod;
}

function setCity_sale_cod($city_sale_cod): void {
    $this->city_sale_cod = $city_sale_cod;
}

function setClient_id($client_id): void {
    $this->client_id = $client_id;
}

function setCollaborator_id($collaborator_id): void {
    $this->collaborator_id = $collaborator_id;
}

function setOrder_status_cod($order_status_cod): void {
    $this->order_status_cod = $order_status_cod;
}

function setCreated_at($created_at): void {
    $this->created_at = $created_at;
}

function setUpdated_at($updated_at): void {
    $this->updated_at = $updated_at;
}



   
}