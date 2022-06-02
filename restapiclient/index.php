<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
//inisialisasi slim  
$app = new \Slim\App;   
     
require 'connection/DBConnection.php';
$container = $app->getContainer();
$container['db'] = function($container){
    $db = new DBConnection();
    return $db;
};

//routing, saat route '/' dengan method get diminta, dia akan mengeksekusi action 
$app->get('/', function (Request $request, Response $response, array $args) {
    $data = array('status'=>'ok');      
    return $response->withJson($data); //response akan menampilkan json hasil konversi $data ke json
});


$app->post("/order", function (Request $request, Response $response){

    $order = $request->getParsedBody();

    $sql = "INSERT INTO tbl_orderan_user (key_user_id, id_menu, jumlah, price, status_order) VALUE ( :key_user_id, :id_menu, :jumlah, :price, :status_order)";
    $stmt = $this->db->prepare($sql);

    $data = [
        ":key_user_id" => $order["keyUser"],
        ":id_menu" => $order["menu"],
        ":jumlah" => $order["jumlah"],
        ":price" => $order["price"],
        ":status_order" => $order["status"]
        
    ];

    if($stmt->execute($data))
       return $response->withJson(["error" => false, "data" => "1"], 200);
    
    return $response->withJson(["error" => true, "dataerror_msg" => "0"], 200);
});


$app->get('/listmenu/{id}/{keyuser}',function (Request $request, Response $response, array $args) {          
    try{
        $sql  = "SELECT tbl_orderan_user.id, tbl_menu_list.gambar_menu, tbl_menu_list.nama_menu, tbl_orderan_user.jumlah, tbl_orderan_user.price, tbl_orderan_user.status_order FROM tbl_orderan_user INNER JOIN tbl_menu_list ON tbl_menu_list.id_menu = tbl_orderan_user.id_menu WHERE (tbl_orderan_user.status_order=:id AND tbl_orderan_user.key_user_id=:keyuser)";  
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array('id'=>$args['id'],'keyuser'=>$args['keyuser']));
        $result = $stmt->fetchALL(\PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        $result = array('error'=>$e->getMessage());
    }
    return $response->withJson($result); 
});

$app->get('/status_orderan/{keyuser}',function (Request $request, Response $response, array $args) {          
    try{
        $sql  = "SELECT tbl_orderan_user.id, tbl_menu_list.gambar_menu, tbl_menu_list.nama_menu, tbl_orderan_user.jumlah, tbl_orderan_user.price, tbl_orderan_user.status_order FROM tbl_orderan_user INNER JOIN tbl_menu_list ON tbl_menu_list.id_menu = tbl_orderan_user.id_menu WHERE (tbl_orderan_user.status_order='Buat' AND tbl_orderan_user.key_user_id=:keyuser) OR tbl_orderan_user.status_order='Kirim' OR tbl_orderan_user.status_order='pending'";  
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array('keyuser'=>$args['keyuser']));
        $result = $stmt->fetchALL(\PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        $result = array('error'=>$e->getMessage());
    }
    return $response->withJson($result); 
});
$app->get('/sukses/{keyuser}',function (Request $request, Response $response, array $args) {          
    try{
        $sql  = "SELECT tbl_orderan_user.id, tbl_menu_list.gambar_menu, tbl_menu_list.nama_menu, tbl_orderan_user.jumlah, tbl_orderan_user.price, tbl_orderan_user.status_order, tbl_orderan_user.tanggal_orderan FROM tbl_orderan_user INNER JOIN tbl_menu_list ON tbl_menu_list.id_menu = tbl_orderan_user.id_menu WHERE (tbl_orderan_user.status_order='Sukses' AND tbl_orderan_user.key_user_id=:keyuser)";  
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array('keyuser'=>$args['keyuser']));
        $result = $stmt->fetchALL(\PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        $result = array('error'=>$e->getMessage());
    }
    return $response->withJson($result); 
});

$app->get('/listmenu/{id}/{keyuser}/jumlahprice',function (Request $request, Response $response, array $args) {          
    try{
        $sql  = "SELECT Coalesce(SUM(price),0) price FROM tbl_orderan_user WHERE (tbl_orderan_user.status_order=:id AND tbl_orderan_user.key_user_id=:keyuser)";  
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array('id'=>$args['id'],'keyuser'=>$args['keyuser']));
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        $result = array('error'=>$e->getMessage());
    }
    $a = array('error'=>'false','price'=>$result );
    return $response->withJson($a); 
});

$app->put('/orderan/pending/{keyuser}/{tanggal}/{alamat}/{add}',function (Request $request, Response $response, array $args) { 
    try{
        $sql  = "UPDATE tbl_orderan_user SET status_order='pending', tanggal_orderan=:tanggal, alamat_antar=:alamat,address_antar=:add WHERE tbl_orderan_user.status_order='checkout' AND tbl_orderan_user.key_user_id=:keyuser";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            'keyuser'=>$args['keyuser'],
            'tanggal'=>$args['tanggal'],
            'alamat'=>$args['alamat'],       
            'add'=>$args['add']
        ));
    }catch(PDOException $e){
        $result = array('error'=>$e->getMessage());
    }
    return $response->withJson(array('status'=>'ok','message'=>'data berhasil di pesan')); 
});
$app->put('/edit/orderan/{id}/{jumlah}/{price}',function (Request $request, Response $response, array $args) { 
    try{
        $sql  = "UPDATE tbl_orderan_user SET jumlah=:jumlah, price=:price WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            'id'=>$args['id'],
            'jumlah'=>$args['jumlah'],
            'price'=>$args['price']
        ));
    }catch(PDOException $e){
        $result = array('error'=>$e->getMessage());
    }
    return $response->withJson(array('status'=>'ok','message'=>'data berhasil di pesan')); 
});

$app->delete('/delete/orderan/{id}',function (Request $request, Response $response, array $args) { 
    try{
        $sql  = "DELETE FROM tbl_orderan_user where id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array('id'=>$args['id']));
    }catch(PDOException $e){
        $result = array('error'=>$e->getMessage());
    }
    return $response->withJson(array('status'=>'ok','message'=>'data has been deleted')); 
});

$app->group('/facefood', function () { //ini adalah group route

    
    $this->get('/listmenu',function (Request $request, Response $response, array $args) {          
        try{
            $sql  = "SELECT * FROM tbl_menu_list";  
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            $result = array('error'=>$e->getMessage());
        }
        return $response->withJson($result); 
    });

    $this->get('/listmenu/{idCategory}',function (Request $request, Response $response, array $args) {          
        try{
            $sql  = "SELECT * FROM tbl_menu_list WHERE tbl_menu_list.id_categori = :idCategory";  
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array('idCategory'=>$args['idCategory']));
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            $result = array('error'=>$e->getMessage());
        }
        return $response->withJson($result); 
    });

    $this->get('/category',function (Request $request, Response $response, array $args) {          
        try{
            $sql  = "SELECT * FROM tbl_categori_list";  
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            $result = array('error'=>$e->getMessage());
        }
        return $response->withJson($result); 
    });

});

$app->get('/lokasi',function (Request $request, Response $response, array $args) {          
    try{
        $sql  = "SELECT tbl_setting.lat_map, tbl_setting.long_map, tbl_setting.jarak_cod FROM tbl_setting";  
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        $result = array('error'=>$e->getMessage());
    }
    $a = array('error'=>'false','lokasi'=>$result );
    return $response->withJson($a); 
});

$app->group('/facefood/user', function () { //ini adalah group route

    $this->get('/detail/{keyuser}',function (Request $request, Response $response, array $args) {          
        try{
            $sql  = "SELECT tbl_user.nama, tbl_user.user_alamat, tbl_user.email, tbl_user.telepone, tbl_user.img_user FROM tbl_user WHERE tbl_user.key_user_id=:keyuser";  
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array('keyuser'=>$args['keyuser']));
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            $result = array('error'=>$e->getMessage());
        }
        $a = array('error'=>'false','user'=>$result );
        return $response->withJson($a); 
    });
    $this->put('/edit/{keyuser}/{nama}/{email}/{alamat}',function (Request $request, Response $response, array $args) { 
        try{
            $sql  = "UPDATE tbl_user SET nama=:nama, email=:email, user_alamat=:alamat WHERE key_user_id=:keyuser";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array(
                'keyuser'=>$args['keyuser'],
                'nama'=>$args['nama'],
                'email'=>$args['email'],
                'alamat'=>$args['alamat']
            ));
        }catch(PDOException $e){
            $result = array('error'=>$e->getMessage());
        }
        return $response->withJson(array('status'=>'ok','message'=>'data berhasil di pesan')); 
    });
    

});

$app->run();