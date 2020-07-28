<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
        body {
           
            
        }
    </style>
</head>
<body>
<div class="header">
    <center><h4>Money Receipt</h4></center>
</div>

<div class="body">
  <div style="">
<ul>
  @php($sum = 0)
  @foreach($infos as $info)
  <li>
    <b>Sender Name:</b>{{$total=$info->amount}}
  </li>
  @php($sum = $sum+$total)
  @endforeach
</ul>
<h5>Total Send Amount: <b>{{$orderTotal = $sum}}</b></h5>
</div>



</div>

</body>
</html>