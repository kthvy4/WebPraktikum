<?php 
//untuk mengelola data produk melalui beberapa metode, yaitu index, getById, insert, update, dan delete.
namespace app\Controller;

include "app/Traits/ApiResponseFormatter.php";
include "app/Models/Product.php";

use app\Models\Product;
use app\Traits\ApiResponseFormatter;

class ProductController{
    use ApiResponseFormatter;

    public function index(){
        //definisi objek model produk yang sudah dibuat
        $productModel = new Product();
        $response = $productModel->findAll();
        //return $response dengan melakukan formattin terlebih dahulu menggunakan trait yang sudah dipanggil
        return $this->apiResponse(200, "success", $response);
    }
    public function getById($id){
        $productModel = new Product();
        $response = $productModel->findById($id);
        return $this->apiResponse(200, "success", $response);
    }
    public function insert(){
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        //validasi input valid atau tidak
        if(json_last_error()){
            return $this->apiResponse(400,"error invalid input", null);
        }
        $productModel = new Product();
        $response = $productModel->create([
            "product_name" => $inputData['product_name']
        ]);
        return $this->apiResponse(200, "success", $response);
    }
    public function update($id){
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        if(json_last_error()){
            return $this->apiResponse(400,"error invalid input", null);
        };
        $productModel = new product();
        $response = $productModel->update([
            "product_name" => $inputData['product_name']
        ], $id);
        return $this->apiResponse(200, "success", $response);
    }
    public function delete($id){
        $productModel = new Product();
        $response = $productModel->delete($id);

        return $this->apiResponse(200, "success", $response);
    }
}

?>