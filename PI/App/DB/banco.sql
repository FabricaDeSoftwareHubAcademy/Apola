/*usando o banco de dados do pi*/ 
use 140p1; 

/*primeiro vou criar as tabelas que não possui id de outras tabelas*/   

/*criando a tabela User*/ 

create table usuario( 
	id_usuario int not null auto_increment, 
	nome varchar(100) not null, 
    email varchar(150) unique not null, 
    senha varchar(80) not null, 
    id_perfil enum("cli","adm") not null, 

    constraint primary key(id_usuario) 

); 

/*criando a tabela categoria*/ 

create table categoria( 
	id_categoria int not null unique auto_increment, 
    nome varchar(100) not null, 
    status_categoria char(1) not null, 
    imagem varchar(100) not null, 

    constraint primary key(id_categoria) 
);

/*criando a tabela de pagamento*/ 

create table pagamento( 
	id_pagamento int not null unique auto_increment, 
    url_whatsapp varchar(100) not null, 
    status_pagamento char(1) not null,
    telefone char(11) unique not null, 
    
    constraint primary key(id_pagamento) 
); 

/*criando a tabela de produtos personalizados*/ 

create table produto_perso( 
	id_produto_perso int not null auto_increment, 
    tipo varchar(100) not null, 
    descricao longtext not null, 

    constraint primary key(id_produto_perso) 
); 

  

/*As tabelas com os id´s primarios ja foram criadas acima. Com isso irei dar inicio a criação das tabelas que irão herdar esses id´s */ 

  
/*criando a tabela cliente*/
  

create table cliente( 
	id_cliente int not null unique auto_increment,
    foto_perfil varchar(250) not null,
    sobrenome varchar(100) not null, 
    cep char(9) not null, 
    cpf char(11) unique not null, 
    telefone char(11) unique, 
    numero_casa int(5), 
    rua varchar(150), 
    bairro varchar(150), 
    estado char(2), 
    cidade varchar (150), 
    complemento varchar(200), 
    id_usuario int not null,
    foreign key(id_usuario) references usuario(id_usuario),

    constraint primary key(id_cliente)
); 

  /*criando a tabela administrador*/

create table administrador( 
	id_administrador int not null auto_increment, 
    id_usuario int not null,
    constraint primary key(id_administrador),
    
    foreign key(id_usuario) references usuario(id_usuario) 
); 

/*criando a tabela avaliacao_loja */

create table avaliacao_loja(
	id_avaliacao_loja int not null auto_increment,
    comentario text not null,
	notas enum('1', '2', '3', '4', '5') not null,
    id_cliente int not null,
    
    constraint primary key(id_avaliacao_loja),
    foreign key(id_cliente) references cliente(id_cliente)
);

/*criando a tabela avaliacao_produto */

create table avaliacao_produto(
	id_avaliacao_produto int not null auto_increment,
    comentario text not null,
    notas enum('1','2','3','4','5') not null,
    id_cliente int not null,
    id_produto int not null,
    
    constraint primary key(id_avaliacao_produto),
    foreign key(id_cliente) references cliente(id_cliente),
    foreign key(id_produto) references produto(id_produto)
);

/*criando a tabela imagens_produto_perso*/ 

create table imagens_produto_perso( 
	id_imagens_produto_perso int not null auto_increment, 
    imagem1 text, 
    imagem2 text, 
    imagem3 text, 
    imagem4 text, 
    id_produto_perso int not null,
    constraint primary key(id_imagens_produto_perso), 
    
    foreign key(id_produto_perso) references produto_perso(id_produto_perso) 
);

/*criando a tabela produto*/ 

create table produto( 
	id_produto int not null unique auto_increment,
    nome varchar(100) not null, 
    status_produto char(1) not null,
    tipo varchar(80) not null,
    preco decimal(10,2) not null, 
    avaliacao longtext, 
    quantidade int not null, 
    cor varchar(45) not null, 
    altura float not null, 
    largura float not null, 
	imagem varchar(100) not null, 
    descricao longtext not null,
    categoria_id_categoria int not null, 
    
    constraint primary key(id_produto), 
    foreign key(categoria_id_categoria) references categoria(id_categoria) 
); 

/*criando a tebela de favoritos*/ 

create table favoritos( 
	id_favoritos int not null unique auto_increment, 
    constraint primary key(id_favoritos), 
    cliente_id_cliente int not null, 
    status_favoritos enum('a','i') not null;
    foreign key(cliente_id_cliente) references cliente(id_cliente), 
    produto_id_produto int not null, 
    foreign key(produto_id_produto) references produto(id_produto) 


); 

/*criando a tabela sacola*/ 

create table sacola( 
	id_sacola int not null unique auto_increment, 
    preco_frete decimal(10,2) not null, 
    valor_total decimal (10,2) not null, 
    cep char(9) not null, 
    quant_produto int not null, 
    produto_id_produto int not null, 
    foreign key(produto_id_produto) references produto(id_produto), 
    cliente_id_cliente int not null, 
    foreign key(cliente_id_cliente) references cliente(id_cliente), 
    produto_categoria_id_categoria int not null, 
    foreign key(produto_categoria_id_categoria) references produto(categoria_id_categoria),
	
     constraint primary key(id_sacola)
); 

/*criando a tabela pedido*/ 

create table pedido( 

	id_pedido int not null unique auto_increment, 
    data_pedido datetime not null, 
    tipo enum("disponivel","personalizado") not null, 
    status_pedido enum("A pagar","Produção","Envio","Entregue") not null, 
    codigo_rastreio varchar(30) unique not null, 
    sacola_id_sacola int not null, 
	foreign key(sacola_id_sacola) references sacola(id_sacola), 
    sacola_produto_id_produto int default null, 
    foreign key(sacola_produto_id_produto) references sacola(produto_id_produto), 
    sacola_produto_categoria_id_categoria int not null, 
    foreign key(sacola_produto_categoria_id_categoria) references sacola(produto_categoria_id_categoria), 
    sacola_cliente_id_cliente int not null, 
    foreign key(sacola_cliente_id_cliente) references sacola(cliente_id_cliente), 
    produto_perso_id_produto_perso int default null,
    foreign key(produto_perso_id_produto_perso) references produto_perso(id_produto_perso),
    id_cliente int not null,
    foreign key(id_cliente) references cliente(id_cliente),
    
    constraint primary key(id_pedido)
); 

/*criando a tablea banners_principais*/

create table banners_principais(
	id_banner int not null auto_increment,
    caminho varchar(250) not null,
    posicao int not null,
    
    constraint primary key(id_banner)
);

/*criando a tabela banners_secundarios*/

create table banners_secundarios(
	id_banner int not null auto_increment,
    caminho varchar(250) not null,
    posicao int not null,
    
    constraint primary key(id_banner)
);

/*criando a tabela banners_promocionais*/

create table banners_promocionais(
	id_banner int not null auto_increment,
    caminho varchar(250) not null,
    posicao int not null,
    
    constraint primary key(id_banner)
);

/*criando a tabela banners_mobile*/

create table banners_mobile(
	id_banner int not null auto_increment,
    caminho varchar(250) not null,
    posicao int not null,
    
    constraint primary key(id_banner)
);