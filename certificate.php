<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cert</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="cert.css">
</head>
<body>

  


<div id="printable-area" style="position: relative; width: 800px; height: 600px;">
  <!-- Background -->
  <img src="certfy.png" style="width: 120%; height: 120%; position: absolute;">


  <!-- Input Fields -->
  <input type="text" id="name" placeholder="Full Name" style="position: absolute; top: 290px; left: 567px; width: 170px; height: 20px">
  <input type="text" id="age" placeholder="Age" style="position: absolute; top: 290px; left: 755px; width: 37px; height: 20px">
  <input type="text" id="status" placeholder="Civil Status" style="position: absolute; top: 318px; left: 325px; width: 87px; height: 20px">
  <input type="text" id="day" placeholder="Day" style="position: absolute; top: 396px; left: 512px; width: 49px; height: 20px">
  <input type="text" id="mm/yy" placeholder="mm/yy" style="position: absolute; top: 396px; left: 630px; width: 150px; height: 20px">
</select>

</div>

<div style="text-align: right; margin-top: 50px;">
  <button class="btn btn-primary mt-3" onclick="prepareForPrint()">Print Form</button>
</div>

<script>
  function prepareForPrint() {
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
      const span = document.createElement('span');
      span.innerText = input.value;
      span.style.cssText = input.style.cssText; // Match styling
      span.className = 'print-text';
      input.parentNode.replaceChild(span, input); // Replace input with span
    });

    // Trigger print
    window.print();

    // Revert back to inputs after printing
    const spans = document.querySelectorAll('.print-text');
    spans.forEach(span => {
      const input = document.createElement('input');
      input.value = span.innerText;
      input.style.cssText = span.style.cssText;
      span.parentNode.replaceChild(input, span);
    });

    
  }
</script>


</body>
</html>
