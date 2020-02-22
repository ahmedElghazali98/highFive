<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Invoice - 1000</title>
        <style>
            *{ font-family: DejaVu Sans; font-size: 12px!important;}

            body,tr,td,h1 { font-family: DejaVu Sans, sans-serif!important; }
            tr,td{
                text-align: center;
            }
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }
            .place {
                text-align: right;
                margin-top: 30px;
            }
            .bank {
                width: 100%;
                height: 70%;
                background: #ffff;
                border: none;
                font-size: 14px;
                font-family: Arial;
                color: black;
                overflow:hidden;
                resize:none;
            }
            a {
                color: #5D6975;
                text-decoration: underline;
            }

            body {
                position: relative;
                padding: 2px;
                width: 19cm;
                height: 26cm;
                margin: 0 auto;
                color: black;
                background: #FFFFFF;
                font-family: DejaVu Sans, sans-serif;
                font-size: 12px;
            }
            header {
                padding: 10px 0;
            }

            #logo {
                float: left;
                margin-bottom: 10px;
            }

            #logo img {
                height: 80px;
            }

            h1 {
                border-top: 1px solid  #5D6975;
                border-bottom: 1px solid  #5D6975;
                color: black;
                font-size: 2.4em;
                line-height: 1.4em;
                font-weight: normal;
                text-align: left;
                margin: 0 0 20px 0;
            }
            h2 {
                color: black;
                font-size: 1.4em;
                line-height: 1.4em;
                font-weight: normal;
                margin: 10px 10px 20px 0;
                text-align: center;
            }
            .inv {
            }
            .users {
                display: block;
                margin-right: 30px;
                margin-left: 30px;
            }
            .seller {
                float: left;
                font-size: 16px;
                margin-bottom: 30px;
            }
            .company {
                float: right;
                font-size: 16px;
                margin-bottom: 30px;
            }

            #seller div,
            #company div {
                white-space: nowrap;
            }
            .table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
                float: right;
            }
            .table tr:nth-child(2n-1) td {
                background: #F5F5F5;
            }
            .table th,
            .table td {
                text-align: right;
            }
            .table th {
                padding: 5px 5px;
                color: #5D6975;
                border-bottom: 1px solid #C1CED9;
                white-space: nowrap;
                font-weight: normal;
            }
            .table .service,
            .table .desc {
                text-align: left;
            }
            .table td {
                padding: 5px;
                text-align: right;
            }
            .table td.service,
            .table td.desc {
                vertical-align: top;
            }
            .table td.unit,
            .table td.qty,
            .table td.total {
                font-size: 1.2em;
            }
            .table td.grand {
                border-top: 1px solid #5D6975;;
            }
            #notices .notice {
                color: #5D6975;
                font-size: 1.2em;
                margin-bottom: 20px;
            }
            footer {
                color: #5D6975;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #C1CED9;
                padding: 8px 0;
                text-align: center;
            }
            .total {
                font-family: Arial;
                font-size: 14px;
            }
            .desc{
                text-align: center;
                direction: rtl;
            }
        </style>
    </head>
    <body>
        <header class="clearfix">

            <div class="inv">
                <h2 style="float: right"><strong>شركة الغفري</strong></h2>
                <h2 style="float: left"><strong> Al-Ghafari Company</strong></h2>

            </div>
           <br>
           <br>
             <div class="inv">
                <h2 style="text-align: center"><strong>مستند إدخال </strong></h2>

            </div>

            <div class="inv">
                <h2 style="float: right"> {{$entry_documents->document}}<strong>عنوان البيان:  </strong> </h2>


            </div>
                <br>
                <br>


        </header>
        <main>

            <table class="table">
                <thead>
                    <tr>
                        <th> الصنف </th>

                        <th> الكمية </th>
                        <th> السعر</th>
                    </tr>
                </thead>
                <tbody>



                    <tr>
                        <td class="desc">{{$entry_documents->document}}</td>

                        <td class="desc">
                            {{$entry_documents->document}}


                        </td>
                        <td class="desc">{{$entry_documents->document}}</td>




                </tbody>
            </table>
            <!--Payment Terms -->

            <!--Bank details -->

        </main>

    </body>
</html>
