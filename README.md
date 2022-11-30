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




$tipo = $request->tipo_proceso;
            $file = $request->file('file');
            $file_name = $request->file_name;
            $file_ir = substr($file_name, 0, -17);
            $file_pro = substr($file_name, 2, -14);
            $file_fecha = substr($file_name, 5, -6);
            $file_v = substr($file_name, 13, 1);
            $file_tipe = substr($file_name, 16);
            $file_len = strlen($file_name);

            $email = $request->email;

            /* VALIDAMOS QUE EL NOMBRE DEL ARCHIVO ESTE BIEN */
            if($file_len != 19 || $file_ir != "IR"){
                return back()->with('mDanger', 'El nombre del archivo no es adecuado, cambielo e intentelo nuevamente!');
            }
            /* VALIDAMOS QUE SEA UN ARCHOVO XLSX */
            if($file_tipe != "csv"){
                return back()->with('mDanger', 'Tipo de archivo erroneo, debe ser formato excel (.xlsx)!');
            }

            $validador_car = actas_cargue::where('Acc_nombre', '=',substr($file_name, 0, -5))->count();
            if($validador_car > 0){
                return back()->with('mDanger', 'Ya subio un archivo con este mismo nombre!');
            }

            /* VALIDAMOS QUE LA FECHA EN EL NOMBRE DEL ARCHIVO ESTE BIEN */
            $year = intval(substr($file_fecha, 0, -4));
            $mes = intval(substr($file_fecha, 4, -2));
            $dia = intval(substr($file_fecha, 6));

            if($mes > 12 || $dia > 31 || $mes < 0 || $dia < 0 || $mes == 0 || $year == 0 || $dia == 0){
                return back()->with('mDanger', 'La fecha dentro del nombre es invalida!');
            }
