<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte final estudiante</title>
    <link href="//db.onlinewebfonts.com/c/a78cfad3beb089a6ce86d4e280fa270b?family=Calibri" rel="stylesheet" type="text/css"/>
    <style>
        .table_defaul table {
            border-collapse: collapse;
            width: 100%;
        }
        .table_defaul td, th {
            border: 1px solid #dddddd;
        }
        #logo{ 
	        position:fixed; 
	        top: 4px;
	        left: 10px; 
        } 
    </style>
</head>
<body>
<div class="container">
    <!--CABECERA-->
    <div id="logo"> 
        <img src="{{env('APP_URL').'/images/logo_epnSin.svg'}}" class="logo" alt="Logo EPN, escudo" style="width: 80px;">
    </div>
    <div class="row">
        <p style="font-family: Calibri; font-size: 11px; font-weight: bold; text-align: right;" >FORMULARIO F_AA_119</p>
        <p>
            <div class="text-center" style="font-family: Calibri; font-size: 16px; font-weight: bold; text-align: center;">ESCUELA POLITÉCNICA NACIONAL</div>
            <div class="text-center" style="font-family: Calibri; font-size: 14px; font-weight: bold; text-align: center;" >ESCUELA DE FORMACION DE TECNÓLOGOS</div>
        </p>
        <br>
        <table>
            <tr>
                <td style="width: 80px; font-family: Calibri; font-size: 14px; font-weight: bold;">CARRERA:</td>
                <td style="width: 400px;font-family: Calibri; font-size: 14px;">{{ $carrer["name"] }}</td>
            </tr>
            <tr>
                <td style="width: 80px; font-family: Calibri; font-size: 14px; font-weight: bold;">MODALIDAD: </td>
                <td style="width: 400px; font-family: Calibri; font-size: 14px;">PRESENCIAL</td>
            </tr>
        </table>

        <p class="text-center" style="font-family: Calibri; font-size: 14px; font-weight: bold;  text-align: center;" >
            INFORME DE PRÁCTICAS PREPROFESIONALES<br>
            (PRÁCTICAS LABORALES O SERVICIO A LA COMUNIDAD)
        </p>
    </div>

    <!--DATOS DE LA EMMPRESA O INSTITUCIÓN  style="border: 0.1px solid black;"-->
    <div class="row">
        <p style="font-family: Tahoma; font-size: 10px; font-weight: bold;" >1. DATOS DE LA EMPRESA O INSTITUCIÓN </p>
        <table>
            <tr>
                <td style="width: 150px; font-family: Tahoma; font-size: 10px; font-weight: bold;">Razón Social:</td>
                <td style="font-family: Tahoma; font-size: 10px;">{{ $company["name"] }}</td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Dirección</td>
                <td style="font-family: Tahoma; font-size: 10px;">{{ $company["address"] }}</td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Correo Electrónico</td>
                <td style="width: 100px; font-family: Tahoma; font-size: 10px;">{{ $company["email"] }}</td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Ciudad:</td>
                <td style="width: 140px; font-family: Tahoma; font-size: 10px;">{{ $company["city"] }}</td>
                <td style="width: 400px;"></td>
                <td style="width: 60px; font-family: Tahoma; font-size: 10px; font-weight: bold;">Teléfono:</td>
                <td style="width: 80px; font-family: Tahoma; font-size: 10px;">{{ $company["phone"] }}</td>
                <td style="width: 60px; font-family: Tahoma; font-size: 10px; font-weight: bold;">Celular:</td>
                <td style="width: 80px; font-family: Tahoma; font-size: 10px;">{{ $company["mobile"] }}</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Tipo de Institución Receptora:</td>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">{{ $company["type"] }}</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Responsable de la Institución Receptora *:</td>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">{{ $representative["lastname"] }} {{ $representative["name"] }}</td>
            </tr>
        </table>
    </div>
    <!--DATOS DEL PRACTICANTE-->
    <br>
    <div class="row">
        <p style="font-family: Tahoma; font-size: 10px; font-weight: bold;" >2. DATOS DEL PRÁCTICANTE </p>
        <table>
            <tr>
                <td style="width: 150px; font-family: Tahoma; font-size: 10px; font-weight: bold;">Nombres y Apellidos:</td>
                <td style="font-family: Tahoma; font-size: 10px;">{{ $student["name"] }} {{ $student["lastname"] }}</td>
            </tr>
            <!--<tr>
                <td style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Cédula de Identidad:</td>
                <td style="font-family: Tahoma; font-size: 10px;">1718536509</td>
            </tr>-->
        </table>
    </div>
    <!--INFORMACIÓN SOBRE LAS PRÁCTICAS LABORALES O SERVICIO A LA COMUNIDAD-->
    <br>
    <div class="row">
        <p style="font-family: Tahoma; font-size: 10px; font-weight: bold;" >3. INFORMACIÓN SOBRE LAS PRÁCTICAS LABORALES O SERVICIO A LA COMUNIDAD</p>
        <table>
            <tr>
                <td style="width: 150px; font-family: Tahoma; font-size: 10px; font-weight: bold;">Tipo de Práctica:</td>
                <td style="font-family: Tahoma; font-size: 10px;">{{ $internship["type"] }}</td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Campo Amplio:</td>
                <td style="font-family: Tahoma; font-size: 10px;"> {{ $internship["wide_field"] }} </td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Campo Específico:</td>
                <td style="font-family: Tahoma; font-size: 10px;">{{ $internship["specific_field"] }}</td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Tutor Académico de la Práctica (EPN):</td>
                <td style="font-family: Tahoma; font-size: 10px;">{{ $teacher["name"] }} {{ $teacher["lastname"] }}</td>
            </tr>
        </table>
        <br>
        <table class="table_defaul">
            <tr>
                <td style="width: 150px; font-family: Tahoma; font-size: 10px; font-weight: bold;">RELACIÓN CON</td>
                <td style="width: 30px; font-family: Tahoma; font-size: 10px; font-weight: bold;">SI</td>
                <td style="width: 30px; font-family: Tahoma; font-size: 10px; font-weight: bold;">NO</td>
                <td style="width: 400px; font-family: Tahoma; font-size: 10px; font-weight: bold;">DETALLE</td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px;">Convenio</td>
                <td style="font-family: Tahoma; font-size: 10px;">@if($internship["institutional_agreement_code"] != "") x @endif</td>
                <td style="font-family: Tahoma; font-size: 10px;">@if($internship["institutional_agreement_code"] == "") x @endif</td>
                <td style="font-family: Tahoma; font-size: 10px;">Código: {{ $internship["institutional_agreement_code"] }} &nbsp; Título: {{ $internship["institutional_agreement_name"] }}</td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px;">Proyecto de Investigación</td>
                <td style="font-family: Tahoma; font-size: 10px;">@if($internship["research_project_code"] != "") x @endif</td>
                <td style="font-family: Tahoma; font-size: 10px;">@if($internship["research_project_code"] == "") x @endif</td>
                <td style="font-family: Tahoma; font-size: 10px;">Código: {{ $internship["research_project_code"] }}&nbsp; Título: {{ $internship["research_project_name"] }}</td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px;">Proyecto de Vinculación</td>
                <td style="font-family: Tahoma; font-size: 10px;">@if($internship["social_project_code"] != "") x @endif</td>
                <td style="font-family: Tahoma; font-size: 10px;">@if($internship["social_project_code"] == "") x @endif</td>
                <td style="font-family: Tahoma; font-size: 10px;">Código: {{ $internship["social_project_code"] }} &nbsp; Título: {{ $internship["social_project_name"] }}</td>
            </tr>
        </table>
        <br>
        <div style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Asignaturas de la malla curricular y temáticas de mayor utilidad para el desarrollo de la práctica:</div>
            <p style="font-family: Tahoma; font-size: 10px;">
                @foreach($useful_topics as $subjects)
                    @foreach($subjects as $topic)
                        {{$topic["name"]}},
                    @endforeach
                @endforeach
            </p>
        </div>
    <!--INFORMACIÓN SOBRE LAS ACTIVIDADES REALIZADAS POR EL ESTUDIANTE-->
    <br>
    <div class="row">
        <p style="font-family: Tahoma; font-size: 10px; font-weight: bold;">4. INFORMACIÓN SOBRE LAS ACTIVIDADES REALIZADAS POR EL ESTUDIANTE </p>
        <table>
            <tr>
                <td style="width: 150px; font-family: Tahoma; font-size: 10px; font-weight: bold;">Área asignada:</td>
                <td style="font-family: Tahoma; font-size: 10px;">{{ $internship["area"] }}</td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Fecha Inicio:</td>
                <td style="font-family: Tahoma; font-size: 10px;">{{ $internship["start_date"] }}</td>
            </tr>
            <tr>
                <td style="width: 150px; font-family: Tahoma; font-size: 10px; font-weight: bold;">Fecha Fin:</td>
                <td style="font-family: Tahoma; font-size: 10px;">{{ $internship["finish_date"] }}</td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Observaciones:</td>
                <td colspan="3" style="font-family: Tahoma; font-size: 10px;">{{ $internship["student_observations"] }}</td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Número total de horas de prácticas:</td>
                <td colspan="3" style="font-family: Tahoma; font-size: 10px;">{{ $internship["hours_worked"] }} horas</td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Principales actividades desarrolladas: </td>
            </tr>
            <tr>
                <td colspan="3" style="font-family: Tahoma; font-size: 10px;">{{ $internship["student_activities"] }} horas</td>
            </tr>
        </table>
    <!--<div style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Habilidades, destrezas o conocimiendos adquiridos durante la práctica: </div>
            <p style="width: 700px; font-family: Tahoma; font-size: 9px;">
                $internship["student_activities"]
        </p>-->
        <table>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px; font-weight: bold;">¿El tutor académico de prácticas preprofesionales de la EPN realizó el seguimiento de la práctica preprofesional?:</td>
                <td style="font-family: Tahoma; font-size: 10px;">SI x</td>
                <td style="font-family: Tahoma; font-size: 10px;">NO </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Observaciones: </td>
            </tr>
            <tr>
                <td colspan="3" style="font-family: Tahoma; font-size: 10px;">{{ $internship["student_observations"] }} horas</td>
            </tr>
        </table>
    </div>
    <br>
    <div class="row">
        <p style="font-family: Tahoma; font-size: 10px; font-weight: bold;" >Evaluación Cualitativa: </p>
        <table class="table_defaul">
            <tr>
                <td style="width: 150px; font-family: Tahoma; font-size: 10px; font-weight: bold;"></td>
                <td style="font-family: Tahoma; font-size: 10px;">Excelente</td>
                <td style="font-family: Tahoma; font-size: 10px;">Muy Buena</td>
                <td style="font-family: Tahoma; font-size: 10px;">Satisfactoria</td>
                <td style="font-family: Tahoma; font-size: 10px;">Deficiente</td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px;">Asistencia y Puntualidad:</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_punctuality"] =='5') x @endif</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_punctuality"] =='4') x @endif</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_punctuality"] =='3') x @endif</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_punctuality"] =='1' or $internship["evaluation_punctuality"] =='2') x @endif</td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px;">Desempeño:</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_performance"] =='5') x @endif</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_performance"] =='4') x @endif</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_performance"] =='3') x @endif</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_performance"] =='1' or $internship["evaluation_performance"] =='2') x @endif</td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px;">Motivación:</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_motivation"] =='5') x @endif</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_motivation"] =='4') x @endif</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_motivation"] =='3') x @endif</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_motivation"] =='1' or $internship["evaluation_motivation"] =='2') x @endif</td>
            </tr>
            <tr>
                <td style="font-family: Tahoma; font-size: 10px;">Conocimientos, Destrezas y Valores:</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_knowledge"] =='5') x @endif</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_knowledge"] =='4') x @endif</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_knowledge"] =='3') x @endif</td>
                <td style="text-align: center; font-size: 10px;">@if($internship["evaluation_knowledge"] =='1' or $internship["evaluation_knowledge"] =='2') x @endif</td>
            </tr>
        </table>
    </div>
    <!--EVALUACION DE LA PRACTICA PREPROFESIONAL-->
    <br>
    <div class="row">
        <p style="font-family: Tahoma; font-size: 10px; font-weight: bold;" >5. EVALUACIÓN DE LA PRÁCTICA PREPROFESIONAL</p>
        <p style="font-family: Tahoma; font-size: 8px;">ESTA INFORMACIÓN DEBE SER LLENADA POR EL TUTOR ACADÉMICO DE PRÁCTICAS PREPROFESIONALES</p>
        <p style="font-family: Tahoma; font-size: 10px; font-weight: bold;">Novedades reportadas o encontradas en el desarrollo de la práctica:</p>
        <p style="font-family: Tahoma; font-size: 9px;">{{ $internship["tutor_observations"] }}</p>
        <p style="font-family: Tahoma; font-size: 10px; font-weight: bold;" >Evaluación Cualitativa:</p>
    </div>
    <table class="table_defaul">
        <tr>
            <td style="width: 300px; font-family: Tahoma; font-size: 10px;">  </td>
            <td style="width: 40px; font-family: Tahoma; font-size: 10px;">SI</td>
            <td style="width: 40px; font-family: Tahoma; font-size: 10px;">NO</td>
            <td style="width: 400px;  font-family: Tahoma; font-size: 10px;">Observaciones</td>
        </tr>
        <tr>
            <td style="width: 300px;font-family: Tahoma; font-size: 10px;">1. ¿Recomienda que otros estudiantes realicen sus prácticas preprofesionales en esta Institución o Empresa?</td>
            <td style="font-family: Tahoma; font-size: 10px;">@if($internship["tutor_recommends"] == 1) x @endif</td>
            <td style="font-family: Tahoma; font-size: 10px;">@if($internship["tutor_recommends"] == 0) x @endif</td>
            <td style="font-family: Tahoma; font-size: 10px;">{{ $internship["tutor_recommends_observations"] }}</td>
        <tr>
            <td style="font-family: Tahoma; font-size: 10px;">2. En general, ¿las prácticas preprofesionales realizadas por el estudiante aportaron a su formación profesional, es decir aportaron a cumplir con su perfil de egreso?</td>
            <td style="font-family: Tahoma; font-size: 10px;">@if($internship["tutor_knowledge_contribution"] == 1) x @endif</td>
            <td style="font-family: Tahoma; font-size: 10px;">@if($internship["tutor_knowledge_contribution"] == 0) x @endif</td>
            <td style="font-family: Tahoma; font-size: 10px;">{{ $internship["tutor_knowledge_contribution_observations"] }}</td>
        </tr>
        <tr>
            <td style="font-family: Tahoma; font-size: 10px;">3. ¿Recomienda la aprobación de las prácticas preprofesionales del estudiante?</td>
            <td style="font-family: Tahoma; font-size: 10px;">@if($internship["tutor_recommends_approval"] == 1) x @endif</td>
            <td style="font-family: Tahoma; font-size: 10px;">@if($internship["tutor_recommends_approval"] == 0) x @endif</td>
            <td style="font-family: Tahoma; font-size: 10px;">{{ $internship["tutor_recommends_approval_observations"] }}</td>
        </tr>
    </table>

    <!--RECOMENDACIÓN DE LA COMISIÓN DE PRÁCTICAS PREPROFESIONALES-->
    <br>
    <div class="row">
        <p style="font-family: Tahoma; font-size: 10px; font-weight: bold;" >6. RECOMENDACIÓN DE LA COMISIÓN DE PRÁCTICAS PREPROFESIONALES</p>
        <p style="font-family: Tahoma; font-size: 10px; font-weight: bold;">La Comisión de Prácticas Preprofesionales, una vez revisada, analizada y validada la información reportada por el estudiante, ¿avala la aprobación de las horas de prácticas preprofesionales indicadas en este informe?</p>
        <div class="row">
            <table>
                <tr>
                    <td style="width: 100px; font-family: Tahoma; font-size: 10px;text-align: center;">@if($internship["commission_approves"] == 1) SI @else NO @endif</td>
                    <td style="font-family: Tahoma; font-size: 10px;">OBSERVACIONES:&nbsp;{{ $internship["commission_observations"]  }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!--CERTIFICACIONES-->
    <br>
    <div class="row">
        <p style="font-family: Tahoma; font-size: 10px; font-weight: bold;" >7. CERTIFICACIONES</p>
    </div>
    <div class="row">
        <table style="width: 100%; text-align: center;">
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px; font-weight: bold;">RESPONSABLE DE LA INSTITUCIÓN RECEPTORA *</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Fecha de Emisión: {{ $internship["finish_date"] }}</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px; height: 60px;">f._________________________________</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Funcionario de la Institución Receptora</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Nonmbre: {{ $representative["name"] }} {{ $representative["lastname"] }}</td>
            </tr>
            <!--<tr>
                <td style="font-family: Tahoma; font-size: 10px;">C.I.: $representative-> }}</td>
            </tr>-->
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Cargo: {{ $representative_company["job_title"] }}</td>
            </tr>
        </table><br>
        <table style="width: 100%; text-align: center;">
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px; font-weight: bold;">TUTOR ACADÉMICO DE PRÁCTICA EPN</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Fecha de Revisión: {{$internship["finish_date"] }}</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px; height: 60px;">f._________________________________</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Tutor</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Nonmbre: {{ $teacher["name"] }} {{ $teacher["lastname"] }}</td>
            </tr>
            <!--<tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">C.I.: 1718536509</td>
            </tr>-->
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Cargo: {{ $teacher_info["degree"] }}</td>
            </tr>
        </table><br>
        <table style="width: 100%; text-align: center;">
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px; font-weight: bold;">COMISIÓN DE PRÁCTICAS PREPROFESIONALES</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Fecha de Revisión: {{$internship["finish_date"] }}</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px; height: 60px;">f._________________________________</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Presidente de la Comisión de Prácticas Preprofesionales</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Nombre: Luis Alfredo Ponce Guevara</td>
            </tr>
            <!--<tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">C.I.: 1718536509</td>
            </tr>-->
        </table><br>
        <table style="width: 100%; text-align: center;">
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px; font-weight: bold;">DECANO(A) DE LA FACULTAD / DIRECTOR(A) DE LA ESFOT</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Fecha de Entrega: {{ $internship["finish_date"] }}</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Fecha de Aprobación: {{ $internship["finish_date"] }}</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Fecha de Registro en SAEw: {{ date('Y-m-d', strtotime($internship["updated_at"])) }}</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px; height: 60px;">f._________________________________</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Máxima Autoridad</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Mónica de Lourdes Vinueza Rhor</td>
            </tr>
            <tr>
                <td colspan="2" style="font-family: Tahoma; font-size: 10px;">Directora ESFOT (e)</td>
            </tr>
        </table>
    </div>
</body>
</html>