<html>
    <header>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Site Profile</title>
        <style>
            body{
                margin: -20px;
                margin-bottom: 10px;
                font-family: 'Helvetica';
            }
            #pdf-header{
                padding: 10px;
                border-bottom: solid #ccc 2px;
            }
            #pdf-header span{
                font-size: 25px;
                text-transform: uppercase;
                text-align: center;
                display: block;
            }
            #pdf-header #survey-title{
                font-size: 9px;
            }
            .siteprofile-table{
                font-size: 9px;
            }
            .dv-40{
                width: 40%;
            }
            .even1{
                background: rgb(149,149,149);
            }
            .even2{
                background: rgb(208,208,208);
            }
            .left-td{
                text-align: right;
            }
            .right-td{
                text-align: center;
            }
            .tableheader{
                background: rgb(42,76,127); 
                border-top: solid rgb(18,29,73) 2px; 
                color: white; 
                text-align: left; 
                text-transform: uppercase; 
                font-weight: normal; 
                padding-top: 3px; 
                padding-left: 2px;
            }
            .no-red{
                color: rgb(183,14,35);
                background: rgb(217,164,164);
            }
            tr.font-8{
                font-size: 8px;
            }
            .font-10{
                font-size: 8px;
            }
            .row {
                margin-right: -15px;
                margin-left: -15px;
                width: 100%;
            }
            .col-lg-12 {
                width: 100%;
            }
            .col-md-3{
                width: 18.5%;
                /*float: left;
                position: relative;*/
                position: absolute;
                top: 0px;
                min-height: 1px;
                padding-right: 15px;
                padding-left: 15px;
            }
            .info-box {
                display: block;
                min-height: 90px;
                background: #fff;
                width: 100%;
                box-shadow: 0 1px 1px rgba(0,0,0,0.1);
                border-radius: 2px;
                margin-bottom: 15px;
                color: white;
            }
            .info-box-content {
                padding: 5px 10px;
            }
            .info-box-text {
                display: block;
                font-size: 16px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .info-box-number {
                display: block;
                font-weight: bold;
                font-size: 22px;
            }
            .info-box .progress, .info-box .progress .progress-bar {
                border-radius: 0;
            }
            .info-box .progress {
                background: #fff;
                margin: 5px -10px 5px -10px;
                height: 1px;
            }
            .progress-description, .info-box-text {
                display: block;
                font-size: 14px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .bg-green{
                background-color: #00a65a !important;
            }
            .bg-aqua{
                background-color: #00c0ef !important;
            }
            .bg-orange {
                background-color: #ff851b !important;
            }
            .bg-gray {
                color: #000;
                background-color: #d2d6de !important;
            }
            .bg-red{
                background-color: #dd4b39 !important;
            }
            .box {
                position: relative;
                border-radius: 3px;
                background: #ffffff;
                border-top: 3px solid #d2d6de;
                margin-bottom: 20px;
                width: 100%;
                box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            }
            .box.box-default {
                border-top-color: #d2d6de;
            }
            .box-body {
                border-top-left-radius: 0;
                border-top-right-radius: 0;
                border-bottom-right-radius: 3px;
                border-bottom-left-radius: 3px;
                padding: 10px;
            }
            .table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 20px;
            }
            .table>thead>tr>th {
                border-bottom: 2px solid #f4f4f4;
                font-size: 14px;
                text-align: left;
            }
            .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
                border-top: 1px solid #f4f4f4;
            }
            .table>thead:first-child>tr:first-child>th {
                border-top: 0;
            }
            .table>tbody>tr>td{
                line-height: 1.42857143;
                vertical-align: top;
            }
            .ticket-td {
                padding: 10px 10px 10px 10px !important;
            }
        </style>
    </header>
    <body>
        <div id="pdf-header">
            <span>Contact Center ng Bayan</span>
            <span style="text-align: center; color: gray; display: block; font-size: 12px;">{{ date("F j, Y", strtotime($startDate)).' - '.date("F j, Y", strtotime($endDate)) }}</span>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-3" style="top: 88px; left: -2%">
                <div class="info-box bg-green">
                    <div class="info-box-content">
                        <span class="info-box-text">New</span>
                        <span class="info-box-number">{{ $n }}</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ round(($n/count($tickets))*100, 2) }}%"></div>
                        </div>
                        <span class="progress-description">
                            {{ round(($n/count($tickets))*100, 2) }}% of the tickets
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="top: 88px; left: 17.5%">
                <div class="info-box bg-aqua">
                    <div class="info-box-content">
                        <span class="info-box-text">Ongoing</span>
                        <span class="info-box-number">{{ $o }}</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ round(($o/count($tickets))*100, 2) }}%"></div>
                        </div>
                        <span class="progress-description">
                            {{ round(($o/count($tickets))*100, 2) }}% of the tickets
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="top: 88px; left: 37%">
                <div class="info-box bg-orange">
                    <div class="info-box-content">
                        <span class="info-box-text">Pending</span>
                        <span class="info-box-number">{{ $p }}</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ round(($p/count($tickets))*100, 2) }}%"></div>
                        </div>
                        <span class="progress-description">
                            {{ round(($p/count($tickets))*100, 2) }}% of the tickets
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="top: 88px; left: 56.5%">
                <div class="info-box bg-gray">
                    <div class="info-box-content">
                        <span class="info-box-text">Closed</span>
                        <span class="info-box-number">{{ $c }}</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ round(($c/count($tickets))*100, 2) }}%"></div>
                        </div>
                        <span class="progress-description">
                            {{ round(($c/count($tickets))*100, 2) }}% of the tickets
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="top: 88px; left: 76%">
                <div class="info-box bg-red">
                    <div class="info-box-content">
                        <span class="info-box-text">Cancelled</span>
                        <span class="info-box-number">{{ $x }}</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ round(($x/count($tickets))*100, 2) }}%"></div>
                        </div>
                        <span class="progress-description">
                            {{ round(($x/count($tickets))*100, 2) }}% of the tickets
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <section class="col-lg-12" style="margin-top: 110px;">
                <div class="box box-default" style="min-height: 250px">
                    <div class="box-body">
                        <table id="table" class="table">
                            <thead>
                                <tr>
                                    <th width="20%">Ticket ID</th>
                                    <th width="20%">Ticket Subject</th>
                                    <th width="20%">Created at</th>
                                    <th width="20%">Assignee</th>
                                    <th width="20%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                <tr>
                                    <td class="ticket-td">
                                        <span class="label label-default sub-time" style="font-size: 11px">{{ $ticket->ticket_id }}</span>
                                    </td>
                                    <td class="ticket-td">
                                        <span class="label label-default sub-time" style="font-size: 11px">{{ $ticket->subject }}</span>
                                    </td>
                                    <td class="ticket-td">
                                        <span class="label label-default sub-time" style="font-size: 11px">{{ $ticket->date_time }}</span>
                                    </td>
                                    <td class="ticket-td">
                                        <span class="label label-default sub-time" style="font-size: 11px">{{ $ticket->assignee_name }}</span>
                                    </td>
                                    <td class="ticket-td">
                                        <span class="label label-default sub-time" style="font-size: 11px">{{ $ticket->status }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>