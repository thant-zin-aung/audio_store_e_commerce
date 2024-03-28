const ctx = document.getElementById('pie-chart');

  new Chart(ctx, {
    type: 'pie',
    data: {
        datasets: [{
          label: 'Top sale chart',
          data: [300, 50, 100],
          backgroundColor: [
            '#363062',
            '#9E4784',
            '#C74B50'
          ],
          hoverOffset: 4
        }],
      },
  });

  let logoutButton = document.getElementsByClassName("logout-button")[0];
  logoutButton.addEventListener("click",event=>{
    window.location="logout.php";
  });