<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>All-In-One (HR)</title>
    <!-- <link rel="icon" type="image/x-icon" href="../img/favicon.ico" /> -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />

    <!-- select2 CDN -->
    <!-- Styles --> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  </head>

  <body>
    <div id="app">

      <!-- NAVBAR-->
      <nav
        class="navbar navbar-light navbar-expand-lg bg-body-secondary"
        style="background-color: #e3f2fd"
      >
        <div class="container-fluid">
          <!-- Shows account type -->
          <a class="navbar-brand" href="manageRoles.html"
            >All-In-One (HR)</a
          >

          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <!-- Navbar tabs for HR -->

              <!-- Manage Roles tab -->
              <li class="nav-item">
                <a
                  class="nav-link active"
                  aria-current="page"
                  href="manageRoles.html"
                  >Manage Roles</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">Manage Candidates</a>
              </li>
            </ul>

            <!-- Switches between account types -->
            <button
              class="btn btn-outline-primary"
              onclick=""
            >
              Switch to Staff View (for demo purpose)
            </button>
          </div>
        </div>
      </nav>

      <!-- HEADER -->
      <div class="container-fluid my-4">
        
        <h2>Update</h2>
        <a class="btn btn-primary" href="" role="button">Link</a>
      </div>

      <!-- SEARCH -->


      <!-- FORM -->
      @foreach ($roles as $role)
      <div class="container">
            <form class="was-validated" id="form" action="/updateRole" method="post">
                @csrf
                <div class="row">
                <!-- Text input (jobTitle) -->
                <div class="mb-3 col-lg-6">
                    <label for="jobTitle" class="form-label">Job Title</label>
                    <input required class="form-control" id="jobTitle" name="jobTitle" placeholder="Enter title" value = "{{$role['role']}}">
                </div>

                <!-- Select input (workArrangement) -->
                <div class="mb-3 col-lg-6">
                    <label for="workArrangement" class="form-label">Work Arrangement</label>
                    <select required class="form-select" id="workArrangement" name="workArrangement">
                    @if ($role['work_arrangement'] == 'Part Time')
                        <option selected>Part Time</option>
                        @else
                        <option>Part Time</option>
                        @endif
                        @if ($role['work_arrangement'] == 'Full Time')
                        <option selected>Full Time</option>
                        @else
                        <option>Full Time</option>
                        @endif
                    </select>
                </div>

                <!-- Select input (department) -->
                <div class="mb-3 col-lg-6">
                    <label for="department" class="form-label">Select Department</label>
                    <select required class="form-select" id="department" name="department">
                        @foreach ($deptDDL as $dept)
                            <option value = "{{ $dept['deptID']}}" {{ $dept['deptID'] == $department ? 'selected' : '' }}>
                                {{$dept['department']}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Select input (hiringManager) -->
                <div class="mb-3 col-lg-6">
                    <label for="hiringManager" class="form-label">Select Hiring Manager</label>
                    <select id="hiringManager"  style="width:100%"  name="hiringManager" class= "form-select select2" multiple>
                        @foreach ($hiringManagerDDL as $hm)
                            <option value = "{{ $hm }}" {{ in_array($hm, $hiring_managers) ? 'selected' : '' }}>
                                {{$hm}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Number input (vacancy) -->
                <div class="mb-3 col-lg-6">
                    <label for="vacancy" class="form-label">Vacancy</label>
                    <input required type="number" class="form-control" id="vacancy" name="vacancy" placeholder="Enter vacancy" value = "{{$role['vacancy']}}">
                </div>

                <!-- Date picker -->
                <div class="mb-3 col-lg-6">
                  <label for="deadline" class="form-label">Deadline</label>
                  <input required type="date" class="form-control" id="deadline" name="deadline" placeholder="DD/MM/YYYY" value="{{$role['deadline']}}">
                  <label id="date-error" for="deadline"></label>
                </div>

                <!-- Skills Required -->
                <div class="mb-3 col-lg-6">
                  <label for="skills" class="form-label">Skills</label>
                  <br>
                  <select required id="skills" style="width:100%" multiple class= "select2" >
                        @foreach ($skillsDDL as $skill)
                            <option value = "{{ $skill['skillID'] }}" {{ in_array($skill['skillID'], $skills) ? 'selected' : '' }}>
                                {{$skill['skill']}}
                            </option>
                        @endforeach
                  </select>
                </div>
    
                <!-- Textarea (description) -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea required class="form-control" id="description" name="description" rows="4" placeholder="Enter description">{{$role['description']}}</textarea>
                </div>
            
                  <!-- Submit button -->
                  <div class="container">
                    <button class="btn btn-primary me-2" id="Save">Save</button>
                    <!-- <button type="submit" class="btn btn-outline-danger">Cancel</button> -->
                  </div>
                </div>

            </form>
      </div>
      @endforeach
       <!-- Bootstrap Bundle -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>

    <script>
      $(document).ready(function() {
        $(".select2").select2({
          theme:'classic'
        });
      });

      document.getElementById("Save").addEventListener("click", checkDate);

      function checkDate(){
        console.log("work")
        let dateChosen = new Date(document.getElementById('deadline').value)
        let today = new Date()
        console.log(dateChosen)
        if (today >= dateChosen){
          $("#form").submit(function(e) {
            e.preventDefault();
          });
          console.log("stop")
          document.getElementById('date-error').show();
        }
        else{
          document.getElementById('date-error').hide();
        }
      }

//       function checkDate(){

// let dateChosen = new Date(document.getElementById('deadline').value);
// let today = new Date();

// if (today >= dateChosen){
//   // Show error
//   document.getElementById('date-error').hidden = false;
//   return; 
// }

// // No error, submit form
// document.getElementById('form').submit();

// }

// document.getElementById("Save").addEventListener("click", checkDate);
      </script>
</body>
</html>