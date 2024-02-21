function updatePrices() {
    let prices = document.getElementsByClassName("subtotalprice");
    let totalQty = 0;
    let overallTotalPrice = 0;

    for (let i = 0; i < prices.length; i++) {
        let priceElement = prices[i];
        let pprice = parseFloat(priceElement.value);

        overallTotalPrice += pprice;

        let qtyInput = priceElement.parentNode.parentNode.querySelector(".qty");
        totalQty += parseInt(qtyInput.value);
    }

    document.getElementById("Tqty").value = totalQty;
    document.getElementById("OverallTotalPrice").value = overallTotalPrice;
}

function changeQuantity(element, increment) {
    let parentRow = element.parentNode.parentNode;
    let qtyInput = parentRow.querySelector(".qty");
    let priceInput = parentRow.querySelector(".price");
    let subtotalInput = parentRow.querySelector(".subtotalprice");

    let unitPrice = parseFloat(priceInput.value);

    if (subtotalInput.value === "") {
        subtotalInput.value = unitPrice;
    }

    let currentQty = parseInt(qtyInput.value) + increment;
    currentQty = Math.max(0, currentQty);
    qtyInput.value = currentQty;

    let subtotal = unitPrice * currentQty;
    subtotalInput.value = subtotal;

    updatePrices();
}

updatePrices(); // call updatePrices after defining the functions

function checkoutBtn() {
  var pric = Number(document.getElementById("OverallTotalPrice").value);
  var a = pric / 276;
  var b = document.getElementById("Tqty").value;
  window.location.href = "order.php?t1=" + a.toFixed(2) + "&t2=" + b;
}
