<?php
require_once(__DIR__ . '/../DB/Database.php');


// use \AllowDynamicProperties;



// #[AllowDynamicProperties]
class Banner{


    public string $caminho;
    public int $posicao;



    public function getBannerForPosicao($tabela, $posicao) {
        $db = new Database($tabela);
        $result = $db->select("posicao = $posicao");

        return $result->fetchObject(self::class);
    }

    public function cadastrarBannersPrincipais() {
        $db = new Database('banners_principais');
        $result = $db->insert([
            'caminho' => $this->caminho,
            'posicao' => $this->posicao
        ]);
        return $result ? true : false;
    }

    public function updateBannersPrincipais() {
        $db = new Database('banners_principais');
        return $db->update(
            'posicao = ' . $this->posicao,
            ['caminho' => $this->caminho]
        );
    }

    public function cadastrarBannersSecundarios() {
        $db = new Database('banners_secundarios');
        $result = $db->insert(['caminho' => $this->caminho]);
        return $result ? true : false;
    }
    
    public function updateBannersSecundarios() {
        $db = new Database('banners_secundarios');
        return $db->update(
            'posicao = ' . $this->posicao,
            ['caminho' => $this->caminho]
        );
    }

    public function cadastrarBannersPromocionais() {
        $db = new Database('banners_promocionais');
        $result = $db->insert(['caminho' => $this->caminho]);
        return $result ? true : false;
    }

    public function updateBannersPromocionais() {
        $db = new Database('banners_promocionais');
        return $db->update(
            'posicao = ' . $this->posicao,
            ['caminho' => $this->caminho]
        );
    }

    public function cadastrarBannersMobile() {
        $db = new Database('banners_mobile');
        $result = $db->insert(['caminho' => $this->caminho]);

        return $result ? true : false;
    }

    public function updateBannersMobile() {
        $db = new Database('banners_mobile');
        return $db->update(
            'posicao = ' . $this->posicao,
            ['caminho' => $this->caminho]
        );
    }

    public function cadastrarBannersSobreMim() {
        $db = new Database('banners_sobre_mim');
        $result = $db->insert(['caminho' => $this->caminho]);
        return $result ? true : false;
    }

    public function updateBannersSobreMim() {
        $db = new Database('banners_sobre_mim');
        return $db->update(
            'posicao = ' . $this->posicao,
            ['caminho' => $this->caminho]
        );
    }
}
