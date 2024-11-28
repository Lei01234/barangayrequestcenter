<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ID</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="brgyID.css">
</head>
<body>

  


<div id="printable-area" style="position: relative; width: 800px; height: 600px;">
  <!-- Background -->
  <img src="brgyID.png" style="width: 115%; height: 100%; position: absolute;">


  <!-- Input Fields -->
  <input type="text" id="name" placeholder="Full Name" style="position: absolute; top: 215px; left: 165px; width: 270px; height: 20px">
  <input type="text" id="adress" placeholder="Address" style="position: absolute; top: 330px; left: 165px; width: 290px; height: 20px">
  <input type="date" id="date" placeholder="Date of Birth" style="position: absolute; top: 430px; left: 159px; width: 100px; height: 20px">
  <input type="text" id="status" placeholder="Civil Status" style="position: absolute; top: 430px; left: 260px; width: 90px; height: 20px">
  <input type="text" id="sex" placeholder="Sex" style="position: absolute; top: 430px; left: 360px; width: 70px; height: 20px">
  
</select>

</div>

<div style="text-align: center; margin-top: 20px;">
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
