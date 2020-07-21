function prod()
{
a = document.p.cost_price.value
b = document.p.poretencion.value
a = parseFloat(a);
b = parseFloat(b);

x = a * b / 100 + a;
document.p.unit_price.value = x;

}