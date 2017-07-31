create table user(
	id int primary key auto_increment,
	user_name varchar(45) not null comment '用户名',
	user_pwd char(32) not null comment '密码'
);

create table order(
	id int primary key auto_increment,
	order_number varchar(50) not null comment '订单编号',
	order_addtime int not null comment '下单时间',
	user_id int not null comment '用户ID'
);

create table goods(
	id int primary key auto_increment,
	goods_name varchar(50) not null comment '商品名称',
	goods_count tinyint not null comment '商品数量',
	order_id int not null comment '订单ID'
);