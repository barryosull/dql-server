<html>
<head>
  <style type="text/css">
    
    body {
      font-family: arial;
    }
    
    textarea {
      font-size: 14px;
      padding: 5px;
      line-height: 150%;
    }
    
    #statement_log {
      color: #888;
      font-size: 12px;
    }
    
    #statement_log div {
      border-left: 1px solid #aaa;
      margin: 5px;
      padding-left: 10px;
    }
    
  </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script type="text/javascript">

$(function(){
    
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' } });
        
    $("#dispatch").click(function(){
        
        var data = {
            command_id: $("#command_id").val(),
            aggregate_id: $("#aggregate_id").val(),
            payload: $("#payload").val()
        };
       $.post("/dql/command-dispatch", data, null, "json").then(success, failure);
    });
   
    function success(data)
    {
        $("#result").html("<div>Success</div>"); 
        var rootEntity = JSON.stringify(data, null, 2);
        $("#root_entity").html("<pre>"+rootEntity+"</pre>");
    }
    
    function failure(jqxhr)
    {
        $("#result").html("<div style='color:red'>Failure</div>")
          .append("<div>"+jqxhr.responseText+"</div>");
    }
    
});


</script>
</head>
<body>
<h3>Enter Ecommerce Command to dispatch</h3>
<div style="width:50%; float:left;">
  <div style="margin-right: 20px;">
    <h4>Command ID</h4>
      <select id="command_id">
        <option value="2af65a9c-5a1d-46d0-b2be-5a102da14cab">Create</option>
        <option value="facad532-1038-438e-a957-01c0ca06b1bd">Add Product</option>
        <option value="d0f0520a-88af-48dd-88bb-73dd68e40114">Remove Product</option>
        <option value="e209a09c-20e2-47d0-a593-f029ab37f362">Change Quantity</option>
        <option value="b1be3927-3468-4e12-9293-21214da121be">Checkout</option>
      </select>
    <h4>Aggregate ID</h4>
    <input type="text" id="aggregate_id" value="{{$aggregate_id}}">
    <h4>Payload (JSON)</h4>
    <textarea style="width:100%;height:100px;" id="payload"></textarea><br>
    <button style="float:right" id="dispatch" type="button">Dispatch</button>
    <div style="clear:both"></div>
    
    <b>Root Entity:</b>
    <div id="root_entity">
    </div>
  </div>
</div>
<div style="width:50%; float:left;">
    <b>Response:</b>
    <div id="result"></div>
</div>
</body>    
</html>