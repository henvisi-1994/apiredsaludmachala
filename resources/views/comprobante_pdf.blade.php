<!doctype html>
<!--Quite a few clients strip your Doctype out, and some even apply their own. Many clients do honor your doctype and it can make things much easier if you can validate constantly against a Doctype.-->
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Email template By Adobe Dreamweaver CC</title>
      <!-- Please use an inliner tool to convert all CSS to inline as inpage or external CSS is removed by email clients -->
      <!-- important in CSS is used to prevent the styles of currently inline CSS from overriding the ones mentioned in media queries when corresponding screen sizes are encountered -->
      <style type="text/css">
         body {
         background-image: url('https://apiapp.saludmachala.gob.ec/img/marca_agua3.png');
        background-repeat: no-repeat;
         }
         body, table, td, p, a, li, blockquote {
         -webkit-text-size-adjust: none!important;
         font-family: sans-serif;
         font-style: normal;
         font-weight: 600;
         }
         button {
         width: 90%;
         }
         @media screen and (max-width:600px) {
         /*styling for objects with screen size less than 600px; */
         body, table, td, p, a, li, blockquote {
         -webkit-text-size-adjust: none!important;
         font-family: sans-serif;
         }
         table {
         /* All tables are 100% width */
         width: 100%;
         }
         .footer {
         /* Footer has 2 columns each of 48% width */
         height: auto !important;
         max-width: 48% !important;
         width: 48% !important;
         }
         table.responsiveImage {
         /* Container for images in catalog */
         height: auto !important;
         max-width: 30% !important;
         width: 30% !important;
         }
         table.responsiveContent {
         /* Content that accompanies the content in the catalog */
         height: auto !important;
         max-width: 66% !important;
         width: 66% !important;
         }
         .top {
         /* Each Columnar table in the header */
         height: auto !important;
         max-width: 48% !important;
         width: 48% !important;
         }
         .catalog {
         margin-left: 0%!important;
         }
         }
         @media screen and (max-width:480px) {
         /*styling for objects with screen size less than 480px; */
         body, table, td, p, a, li, blockquote {
         -webkit-text-size-adjust: none!important;
         font-family: sans-serif;
         }
         table {
         /* All tables are 100% width */
         width: 100% !important;
         border-style: none !important;
         }
         .footer {
         /* Each footer column in this case should occupy 96% width  and 4% is allowed for email client padding*/
         height: auto !important;
         max-width: 96% !important;
         width: 96% !important;
         }
         .table.responsiveImage {
         /* Container for each image now specifying full width */
         height: auto !important;
         max-width: 96% !important;
         width: 96% !important;
         }
         .table.responsiveContent {
         /* Content in catalog  occupying full width of cell */
         height: auto !important;
         max-width: 96% !important;
         width: 96% !important;
         }
         .top {
         /* Header columns occupying full width */
         height: auto !important;
         max-width: 100% !important;
         width: 100% !important;
         }
         .catalog {
         margin-left: 0%!important;
         }
         button {
         width: 90%!important;
         }
         }
         .punteado{
         border-style: dotted;
         border-width: 1px;
         border-color: 660033;
         background-color: cc3366;
         font-family: verdana, arial;
         font-size: 10pt;
         }
      </style>
   </head>
   <body yahoo="yahoo">
      <table width="100%">
         <tbody>
            <tr>
               <td>
                  <table width="100%"  align="center">
                     <!-- Main Wrapper Table with initial width set to 60opx -->
                     <tbody>
                        <tr>
                           <!-- Introduction area -->
                           <td>
                              <table width="70%"  align="center" style="padding-top: 18%">
                                 <tr>
                                    <!-- Row container for Intro/ Description -->

                                    <td align="left" style="font-size: 14px; font-style: normal; font-weight: 100; color: black; line-height: 1.8; text-align:justify; padding:10px 20px 0px 20px; font-family: sans-serif;">
                                    <p style="font-size: 18
                                          px; color:black; font-family: sans-serif; ">COMPROBANTE DE PAGO</p>
                                       <p>Fecha: {{$fecha}}</p>
                                       <p>Paciente: {{$username}}</p>
                                       <p>Cedula Cliente: {{$identificacion}}</p>
                                       <p>Médico: {{$nomb_medico}}</p>
                                       <p>Dcto Nro: {{$num_comprobante}}</p>
                                       <p>Centro Medico: {{$nomb_centMedico}}</p>
                                       <p>Fecha de Cita: {{$auxFecha}}</p>
                                       <p>Hora de Cita: {{$auxhora}}</p>
                                       <table>
                                          <caption align="center">DETALLE</caption>
                                          <colgroup>
                                             <col style="width: 50%"/>
                                             <col style="width: 75% padding-left: 5%"/>
                                             <col style="width: 100%"/>
                                          </colgroup>
                                          <thead>
                                             <tr>
                                                <th>DESCRIPCION</th>
                                                <th>Cantidad</th>
                                                <th>Precio Unit</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <th>CONSULTA {{$especialidad}}</th>
                                                <td> <blockquote>      1    </blockquote>
                                                </td>
                                                <td><blockquote>      {{$precio}}  </blockquote></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <p>Sub-Total Iva 0%: {{$precio}}</p>
                                       <p>Sub-Total Iva 12%: 0</p>
                                       <p>Sub-Total: {{$precio}}</p>
                                       <p>Descuentos: 0.00</p>
                                       <p>I.V.A: 0.00</p>
                                       <br>
                                       <p>TOTAL: {{$precio}}</p>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
   </body>
</html>
