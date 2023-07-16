
// $("#searchButton").click(function (e) {
//     e.preventDefault();
//     console.log(666);
//     let overhead_code = $("#overhead_code").val();
//     window.location.replace("/admin/super/edit/overhead_code="+overhead_code);
//     console.log(overhead_code);
// });

let cookieData = "";
//$("input[name='from_name']").val().length
let tmp = localStorage.getItem("tmp");
let inputFromName = $("input[name='from_name']");
console.log(tmp);
$("input").change(function(e){
	localStorage.removeItem("tmp");
	let from_name = $("input[name='from_name']").val();
	let from_company = $("input[name='from_company']").val();
	let from_phone = $("input[name='from_phone']").val();
	let from_city = $("select[name='from_city']").val();
	let from_address = $("input[name='from_address']").val();
	let to_name = $("input[name='to_name']").val();
	let to_company = $("input[name='to_company']").val();
	let to_phone = $("input[name='to_phone']").val();
	let to_city = $("select[name='to_city']").val();
	let to_address = $("input[name='to_address']").val();
	
	localStorage.setItem("tmp", JSON.stringify({
		"from_name":from_name,
		"from_company":from_company,
		"from_phone":from_phone,
		"from_city":from_city,
		"from_address":from_address,
		"to_name":to_name,
		"to_company":to_company,
		"to_phone":to_phone,
		"to_city":to_city,
		"to_address":to_address,
		}));
});

if(tmp !== null){
	let parts = JSON.parse(tmp);
	let from_name = parts["from_name"];
	let from_company = parts["from_company"];
	let from_phone = parts["from_phone"];
	let from_city = parts["from_city"];
	let from_address = parts["from_address"];
	let to_name = parts["to_name"];
	let to_company = parts["to_company"];
	let to_phone = parts["to_phone"];
	let to_city = parts["to_city"];
	let to_address = parts["to_address"];
	$("input[name='from_name']").val(from_name);
	$("input[name='from_company']").val(from_company);
	$("select[name='from_city']").val(from_city);
	$("input[name='from_phone']").val(from_phone);
	$("input[name='from_address']").val(from_address);
	
	$("input[name='to_name']").val(to_name);
	$("input[name='to_company']").val(to_company);
	$("select[name='to_city']").val(to_city);
	$("input[name='to_phone']").val(to_phone);
	$("input[name='to_address']").val(to_address);
	localStorage.removeItem("tmp");
}