<!-- NOTAS DE DESARROLLADOR -->

<!-- consultas reportes -->

SELECT tge.tge_nombre, IFNULL(T1.cantidad, 0) AS cantidad
FROM tipos_gestiones AS tge
LEFT JOIN (
    SELECT tge.tge_nombre AS tge_nombre, count(pro.tge_id) AS cantidad
    FROM procesos AS pro
    INNER JOIN tipos_gestiones AS tge ON tge.tge_id = pro.tge_id
    INNER JOIN cargues AS car ON car.car_id = pro.car_id
    INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
    WHERE pro.pro_estado = 1
    AND car.tpp_id = 7
    AND pac.dep_id = ".$dep_id."
    AND pro.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'
    GROUP BY tge.tge_nombre
) T1 ON T1.tge_nombre = tge.tge_nombre

AND pro.created_at BETWEEN '2010-10-10' AND '2025-10-10'

SELECT count(pro.tge_id) AS cantidad
                FROM procesos AS pro
                INNER JOIN tipos_gestiones AS tge ON tge.tge_id = pro.tge_id
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND car.tpp_id = 7
                AND pac.dep_id = ".$dep_id."
                AND pro.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."' 


SELECT COUNT(pro.pro_id) AS cantidad
                FROM procesos AS pro
                INNER JOIN cargues AS car ON car.car_id = pro.car_id
                INNER JOIN pacientes AS pac ON pac.pac_id = pro.pac_id
                WHERE pro.pro_estado = 1
                AND car.tpp_id = 7
                AND pac.dep_id = 70
                AND pro.created_at BETWEEN '".$fecha_ini."' AND '".$fecha_fin."' 
