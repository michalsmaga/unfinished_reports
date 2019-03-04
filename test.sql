-- QUERY OK

-- create table gs_objects (imei varchar(20) not null, protocol varchar(50) not null, net_protocol varchar(3) not null, ip varchar(50) not null, port varchar(10) not null, active varchar(5) not null, object_expire varchar(5) not null, object_expire_dt date not null, manager_id int(11) not null, dt_server datetime not null, dt_tracker datetime not null, lat double not null, lng double not null, altitude double not null, angle double not null, speed double not null, loc_valid int(1) not null, params varchar(2048) not null, dt_last_stop datetime not null, dt_last_idle datetime not null, dt_last_move datetime  not null, name varchar(50) not null, icon varchar(256) not null, map_arrows varchar(512) not null, map_icon varchar(5) not null, tail_color varchar(7) not null, tail_points int(4) not null, device varchar(30) not null, sim_number varchar(50) not null, model varchar(50) not null, vin varchar(50) not null, plate_number varchar(50) not null, odometer_type varchar(10) not null, engine_hours_type varchar(10) not null, odometer double not null, engine_hours int(11) not null, fcr varchar(512) not null, time_adj varchar(30) not null, accuracy varchar(1024) not null, dt_chat datetime not null,PRIMARY KEY (imei));

-- query OK

-- insert into gs_objects (imei, protocol, net_protocol, ip, port, active, object_expire, object_expire_dt, manager_id, dt_server, dt_tracker, lat, lng, altitude, angle, speed, loc_valid, params, dt_last_stop, dt_last_idle, dt_last_move, name, icon, map_arrows, map_icon, tail_color, tail_points, device, sim_number, model, vin, plate_number, odometer_type, engine_hours_type, odometer, engine_hours, fcr, time_adj, accuracy, dt_chat) value ('864802030067940', 'queclinkgv75w', 'tcp', '41.13.192.65', '11618', 'true', 'false', '0000-00-00', 0, '2019-02-27 11:50:55', '2019-02-27 11:48:28', -34.369333, 21.400052, 69, 112, 0, 1, '{"mcc":"0655","mnc":"0001","lac":"07E0","cellid":"E74356","odo":"0","batp":"100","acc":"0","di1":"0","di2":"0","di3":"0","do1":"0","do2":"0","do3":"0"}', '2019-02-25 13:29:37', '0000-00-00 00:00:00', '2019-02-25 13:24:37', 'African Queen', 'data/user/objects/1_c03586b40500d0fd02bec878127e75cc.png', '{"arrow_no_connection":"arrow_red","arrow_stopped":"arrow_red","arrow_moving":"arrow_green","arrow_engine_idle":"off"}', 'arrow', '#00FF44', 7, 'VMS MT75W', '', '', '', '', 'off', 'off', 0, 0, '{"source":"rates","measurement":"l100km","cost":"0","summer":"0","winter":"0","winter_start":"12-01","winter_end":"03-01"}', '', '{"stops":"gps","min_moving_speed":"6","min_idle_speed":"3","min_diff_points":"0.0005","use_gpslev":false,"min_gpslev":"5","use_hdop":false,max_hdop":"3","min_fuel_speed":"10","min_ff":"10","min_ft":"10"}', '0000-00-00 00:00:00');


-- query OK

-- create table gs_object_data_864802030067940 (dt_server datetime not null, dt_tracker datetime not null, lat double, lng double, altitude double, angle double, speed double,params varchar(2048) not null);

-- query OK

-- insert into gs_object_data_864802030067940 (dt_server, dt_tracker, lat, lng, altitude, angle, speed, params) value ('2019-02-27 11:50:55', '2019-02-27 11:48:28', -34.369333, 21.400052, 69, 112, 0, '{"mcc":"0655","mnc":"0001","lac":"07E0","cellid":"E74356","odo":"0","batp":"100","acc":"0","di1":"0","di2":"0","di3":"0","do1":"0","do2":"0","do3":"0"}');
-- insert into gs_object_data_864802030067940 (dt_server, dt_tracker, lat, lng, altitude, angle, speed, params) value ('2019-02-27 09:50:40', '2019-02-27 09:48:39', -34.369333, 21.400052, 69, 112, 0, '{"mcc":"0655","mnc":"0001","lac":"07E0","cellid":"E74356","odo":"0","batp":"100","acc":"0","di1":"0","di2":"0","di3":"0","do1":"0","do2":"0","do3":"0"}');
-- insert into gs_object_data_864802030067940 (dt_server, dt_tracker, lat, lng, altitude, angle, speed, params) value ('2019-02-27 07:50:25', '2019-02-27 07:47:59', -34.369333, 21.400052, 69, 112, 0, '{"mcc":"0655","mnc":"0001","lac":"07E0","cellid":"E74356","odo":"0","batp":"100","acc":"0","di1":"0","di2":"0","di3":"0","do1":"0","do2":"0","do3":"0"}');
-- insert into gs_object_data_864802030067940 (dt_server, dt_tracker, lat, lng, altitude, angle, speed, params) value ('2019-02-27 05:50:11', '2019-02-27 05:48:09', -34.369333, 21.400052, 69, 112, 0, '{"mcc":"0655","mnc":"0001","lac":"07E0","cellid":"E73DB9","odo":"0","batp":"100","acc":"0","di1":"0","di2":"0","di3":"0","do1":"0","do2":"0","do3":"0"}');
-- insert into gs_object_data_864802030067940 (dt_server, dt_tracker, lat, lng, altitude, angle, speed, params) value ('2019-02-27 03:49:58', '2019-02-27 03:47:30', -34.369333, 21.400052, 69, 112, 0, '{"mcc":"0655","mnc":"0001","lac":"07E0","cellid":"E73DB9","odo":"0","batp":"100","acc":"0","di1":"0","di2":"0","di3":"0","do1":"0","do2":"0","do3":"0"}');
-- insert into gs_object_data_864802030067940 (dt_server, dt_tracker, lat, lng, altitude, angle, speed, params) value ('2019-02-27 01:49:42', '2019-02-27 01:47:39', -34.369333, 21.400052, 69, 112, 0, '{"mcc":"0655","mnc":"0001","lac":"07E0","cellid":"E73DB9","odo":"0","batp":"100","acc":"0","di1":"0","di2":"0","di3":"0","do1":"0","do2":"0","do3":"0"}');
-- insert into gs_object_data_864802030067940 (dt_server, dt_tracker, lat, lng, altitude, angle, speed, params) value ('2019-02-26 23:49:37', '2019-02-26 23:47:00', -34.369333, 21.400052, 69, 112, 0, '{"mcc":"0655","mnc":"0001","lac":"07E0","cellid":"E73DB9","odo":"0","batp":"100","acc":"0","di1":"0","di2":"0","di3":"0","do1":"0","do2":"0","do3":"0"}');
-- insert into gs_object_data_864802030067940 (dt_server, dt_tracker, lat, lng, altitude, angle, speed, params) value ('2019-02-26 21:49:21', '2019-02-26 21:47:09', -34.369333, 21.400052, 69, 112, 0, '{"mcc":"0655","mnc":"0001","lac":"07E0","cellid":"E73CBB","odo":"0","batp":"100","acc":"0","di1":"0","di2":"0","di3":"0","do1":"0","do2":"0","do3":"0"}');
-- insert into gs_object_data_864802030067940 (dt_server, dt_tracker, lat, lng, altitude, angle, speed, params) value ('2019-02-26 19:49:07', '2019-02-26 19:46:35', -34.369333, 21.400052, 69, 112, 0, '{"mcc":"0655","mnc":"0001","lac":"07E0","cellid":"E73CBB","odo":"0","batp":"100","acc":"0","di1":"0","di2":"0","di3":"0","do1":"0","do2":"0","do3":"0"}');
-- insert into gs_object_data_864802030067940 (dt_server, dt_tracker, lat, lng, altitude, angle, speed, params) value ('2019-02-26 17:48:51', '2019-02-26 17:46:39', -34.369333, 21.400052, 69, 112, 0, '{"mcc":"0655","mnc":"0001","lac":"07E0","cellid":"E74356","odo":"0","batp":"100","acc":"0","di1":"0","di2":"0","di3":"0","do1":"0","do2":"0","do3":"0"}');
