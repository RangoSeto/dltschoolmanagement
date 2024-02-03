$(document).ready(function(){

	//Start Left Side Bar
	$(".sidebarlinks").click(function(){
		$('.sidebarlinks').removeClass('currents');
		$(this).addClass('currents');
	});

	//End Left Side Bar
});

// Start Js Area 

// Start Site Setting 

const getsitesettings = document.getElementById('sitesettings');
getsitesettings.addEventListener('click', function() {
  document.body.classList.toggle('show-nav');
})

// End Site Setting

// Start Top Sidebar 

// start notify & userlogout 

// start dropdown
function dropbtn(e){
	// console.log(e.target);
	e.target.parentElement.nextElementSibling.classList.toggle('show');
}
// end dropdown

// end notify & userlogout 

// End Top Sidebar

// Start Gauge Area
var gaugeurs = new JustGage({
            id: "gaugeusers", // the id of the html element
            width: 200,
            height: 200,
            value: 50,
            min: 0,
            max: 70,
            gaugeWidthScale: 0.6
        });

var gaugecus = new JustGage({
              id: "gaugecustomers", // the id of the html element
              width: 200,
              height: 200,
              value: 700000,
              min: 0,
              max: 900000,
              gaugeWidthScale: 0.6
            });

var gaugeemps = new JustGage({
              id: "gaugeemployees", // the id of the html element
              width: 200,
              height: 200,
              value: 80,
              min: 0,
              max: 100,
              gaugeWidthScale: 0.6
            });

var gaugeinvs = new JustGage({
              id: "gaugeinvesters", // the id of the html element
              width: 200,
              height: 200,
              value: 40,
              min: 0,
              max: 50,
              gaugeWidthScale: 0.6
            });

// update the value randomly
setInterval(() => {
  gaugeurs.refresh(Math.random() * 100);
  gaugecus.refresh(Math.random() * 100);
  gaugeemps.refresh(Math.random() * 100);
  gaugeinvs.refresh(Math.random() * 100);
}, 5000)
// End Gauge Area

// 22GG

// Start Expense Area
const ctx = document.getElementById('mypiechart');
ctx.height = 250;
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [12, 19, 3],
      }]
    },
    options: {
    	responsive: false
    }
  });
// End Expense Area

// Start Earning Area 
google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
// End Earning Area

// End JS Area 

// let result = Math.min(10,20,5,6,8,2,60,18,7);
// console.log(result);
// let results = Math.max(10,20,5,6,8,2,60,18,7);
// console.log(results);

// Get Minimu Number
// var arrnums = [5,10,15,3,7,8,20,6];

// function getminnumber(numbers){

//   let minnumber = numbers[0];

//   for(var x = 0; x < numbers.length; x++){
//     //Get Mini Number 
//     // if(numbers[x] < minnumber){
//     //   minnumber = numbers[x];  //3
//     // }

//     //Get Max Number 
//     if(numbers[x] > minnumber){
//       minnumber = numbers[x];  //3
//     }

//   }

//   return minnumber;
// }

// console.log(getminnumber(arrnums));


// ----------------------------------

// var arrnumstwo = [5,10,15,3,7,8,20,6];

// function sortmaxtominnum(numbers){

//   for(let y= 0; y < numbers.length; y++){

//     let maxnumber = numbers[y];
//     let curidx = y;


//     // let maxnumber = numbers[0];
//     // let curidx;

//     // for(let x = 0; x < numbers.length; x++){
//     for(let x = y; x < numbers.length; x++){

//       // Get Max Number
//       if(numbers[x] > maxnumber){
//         maxnumber = numbers[x];
//         curidx = x;
//       }

//       // Get Min Number
//       // if(numbers[x] < maxnumber){
//       //   maxnumber = numbers[x];
//       //   curidx = x;
//       // }

//     }

//     // return maxnumber; //20/

//     // return [maxnumber,curidx]; // [20,6]

//     // swap idx6 to idx0
//     // numbers[curidx] = numbers[0]; //5
//     // return [maxnumber,curidx,numbers]; // 20 6 [5,10,15,3,7,8,5,6]
//     // numbers[0] = maxnumber; //20
//     // return [maxnumber,curidx,numbers]; // 20 6 [20,10,15,3,7,8,5,6]

//     numbers[curidx] = numbers[y];
//     numbers[y] = maxnumber;
//   }

//   return numbers;

// }


// console.log(sortmaxtominnum(arrnumstwo));

// -----------------------------------------


let saledatas = [
{
  title:"Order Values",
  rank:80,
  value:"12.8%",
  color:"bg-secondary"
},
{
  title:"Total Products",
  rank:50,
  value:"325.8%",
  color:"bg-success"
},
{
  title:"Quantity",
  rank:70,
  value:"25.60%",
  color:"bg-warning"
},
{
  title:"New SKU",
  rank:43,
  value:"13.34%",
  color:"bg-info"
},
{
  title:"Dept",
  rank:10,
  value:"3.40%",
  color:"bg-danger"
}
];

function sortmaxtominnum(saledatas){

  for(let y= 0; y < saledatas.length; y++){

    let maxnumber = saledatas[y];
    let curidx = y;

    for(let x = y; x < saledatas.length; x++){

      // Get Max Number
      if(saledatas[x].rank > maxnumber.rank){
        maxnumber = saledatas[x];
        curidx = x;
      }

    }

    saledatas[curidx] = saledatas[y];
    saledatas[y] = maxnumber;
  }

  return saledatas;

}


function showsaledatas(sortdatas){

  let getsalecnt = document.getElementById("salescontainer");

  let progress = "<div>";

  for(let x = 0; x < sortdatas.length; x++){
    progress += `
      <div class="mt-2">
        <div class="d-flex justify-content-between">
          <small>${sortdatas[x].title}</small>
          <small>${sortdatas[x].value}</small>
        </div>
        <div class="progress">
          <div class="progress-bar ${sortdatas[x].color}" style="width:${sortdatas[x].rank}%;" aria-value-now="80" aria-value-min="0" aria-value-max="100"></div>
        </div>
      </div>
    `;
  }

  progress += "</div>";
  

  getsalecnt.innerHTML = progress;


}

window.onload = function(){
  let sortdatas = sortmaxtominnum(saledatas);
  showsaledatas(sortdatas);
}


// Start Footer 
const getyear = document.getElementById('getyear');
const getfullyear = new Date().getFullYear();
getyear.textContent = getfullyear;
// End Footer

// 7RP