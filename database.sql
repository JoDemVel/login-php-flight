CREATE TABLE public.rol (
	id serial4 NOT NULL,
	"name" varchar(50) NOT NULL,
	"type" varchar(50) NOT NULL,
	CONSTRAINT rol_pkey PRIMARY KEY (id)
);

CREATE TABLE public."user" (
	id serial4 NOT NULL,
	username varchar(80) NOT NULL,
	"password" varchar(20) NOT NULL,
	email varchar(100) NOT NULL,
	phone int4 NOT NULL,
	status bool NULL,
	rol_id int4 NOT NULL,
	CONSTRAINT user_pkey PRIMARY KEY (id)
);

ALTER TABLE public."user" ADD CONSTRAINT user_rol_id_fkey
    FOREIGN KEY (rol_id) REFERENCES public.rol(id);

INSERT INTO public.rol ("name","type") VALUES
	 ('Admin','admin'),
	 ('User','user');

INSERT INTO public."user" (username,"password",email,phone,status,rol_id) VALUES
	 ('jabocov','6969','jaco@gmail.com',1234567,true,2),
	 ('jodemveliz','777777','josue@gmail.com',6941231,true,1),
	 ('jodemvel','12345','josue.veliz@gmail.com',6941233,true,2),
	 ('juapo','12345','ju.pi@gmail.com',6941233,true,2),
	 ('juapija','12345','ju.pi@gmail.com',6941233,true,2),
	 ('juapija','12345','ju.pi@gmail.com',6941233,true,2),
	 ('juapijaaaaa','12345','ju.pi@gmail.com',6941233,true,2);
