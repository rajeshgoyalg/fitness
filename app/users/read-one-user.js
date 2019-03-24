$(document).ready(function () {
  // handle 'read one' button click
  $(document).on("click", ".read-one-user-button", function () {
    // get user workout plan id
    var id = $(this).attr("data-id");
    // read workout plan record based on given ID
    $.getJSON(
      "http://localhost:8080/fitness/api/plan/read_one.php?id=" + id,
      function (data) {
        // html for workout plan details
        var read_plans_html = `
        <!-- when clicked, it will load the create plan form -->
        <div id='create-day-button' class='btn btn-primary pull-right m-b-15px create-day-button'>
            <span class='glyphicon glyphicon-plus'></span> Add day
        </div>
        <!-- start table -->
        <ul class="list-group">`;
        // loop through returned list of data
        $.each(data.days, function (key, val) {
          // creating new table row per record
          read_plans_html +=
            `
            <li class="list-group-item active">` + val.day_workout + `</li>`;
          // loop through returned list of data
          $.each(data.days[key].day_exercises, function (key1, val1) {
            // creating new table row per record
            read_plans_html +=
              `
              <li class="list-group-item">` + val1.exercise_name + `</li>`;
          });
        });

        // end table
        read_plans_html += `</ul>`;

        // start html
        var read_one_plan_html =
          ` 
        <!-- when clicked, it will show the user's list -->
        <div id='read-users' class='btn btn-primary pull-right m-b-15px read-users-button'>
            <span class='glyphicon glyphicon-list'></span> Plan overview
        </div>
        <!-- plan data will be shown in this table -->
        <table class='table table-bordered table-hover'>        
            <!-- plan name -->
            <tr>
                <td class='w-30-pct'>Plan</td>
                <td class='w-70-pct'>` + data.name + `</td>
            </tr>    
        </table>` + read_plans_html;
        // inject html to 'page-content' of our app
        $("#page-content").html(read_one_plan_html);
        // chage page title
        changePageTitle("Plan detail");
      }
    );
  });
});
