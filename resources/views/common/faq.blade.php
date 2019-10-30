@extends('layouts.guest')

@section('content')
    @include('partials.guest.header') <br><br><br><br>

  <div class="container faq">
        <h1>Getbus FAQ</h1><br>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <br>
      <div class="accordion-wrapper">
        <button class="accordion">Section</button>
        <div class="details-faq">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utlabore et dolore magna aliqua. Utenim adminim veniam, quisnostrud exercitation ullamco laboris nisiut aliquip exea commodo consequat.</p>
        </div>
      </div>
      <div class="accordion-wrapper">
        <button class="accordion">Section</button>
        <div class="details-faq">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utlabore et dolore magna aliqua. Utenim adminim veniam, quisnostrud exercitation ullamco laboris nisiut aliquip exea commodo consequat.</p>
        </div>
      </div>
      <div class="accordion-wrapper">
        <button class="accordion">Section</button>
        <div class="details-faq">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utlabore et dolore magna aliqua. Utenim adminim veniam, quisnostrud exercitation ullamco laboris nisiut aliquip exea commodo consequat.
          </p>
        </div>
      </div>
      <div class="accordion-wrapper">
        <button class="accordion">Section</button>
        <div class="details-faq">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utlabore et dolore magna aliqua. Utenim adminim veniam, quisnostrud exercitation ullamco laboris nisiut aliquip exea commodo consequat.
          </p>
        </div>
      </div>
      <div class="accordion-wrapper">
        <button class="accordion">Section</button>
        <div class="details-faq">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utlabore et dolore magna aliqua. Utenim adminim veniam, quisnostrud exercitation ullamco laboris nisiut aliquip exea commodo consequat.
          </p>
        </div>
      </div>
      <div class="accordion-wrapper">
        <button class="accordion">Section</button>
        <div class="details-faq">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utlabore et dolore magna aliqua. Utenim adminim veniam, quisnostrud exercitation ullamco laboris nisiut aliquip exea commodo consequat.
          </p>
        </div>
      </div>
      <div class="accordion-wrapper">
        <button class="accordion">Section</button>
        <div class="details-faq">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utlabore et dolore magna aliqua. Utenim adminim veniam, quisnostrud exercitation ullamco laboris nisiut aliquip exea commodo consequat.
          </p>
        </div>
      </div>
      <div class="accordion-wrapper">
        <button class="accordion">Section</button>
        <div class="details-faq">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utlabore et dolore magna aliqua. Utenim adminim veniam, quisnostrud exercitation ullamco laboris nisiut aliquip exea commodo consequat.
          </p>
        </div>
      </div>
      <div class="accordion-wrapper">
        <button class="accordion">Section</button>
        <div class="details-faq">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utlabore et dolore magna aliqua. Utenim adminim veniam, quisnostrud exercitation ullamco laboris nisiut aliquip exea commodo consequat.
          </p>
        </div>
      </div>
      <div class="accordion-wrapper">
        <button class="accordion">Section</button>
        <div class="details-faq">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utlabore et dolore magna aliqua. Utenim adminim veniam, quisnostrud exercitation ullamco laboris nisiut aliquip exea commodo consequat.
          </p>
        </div>
      </div>
  </div>
<br><br>
@endsection

@section('javascript')
    @parent
    <script type="text/javascript">
      var accordion = document.getElementsByClassName("accordion");

      for (let i = 0; i < accordion.length; i++) {
        accordion[i].addEventListener("click", function(){
          this.classList.toggle("active");
          var details = this.nextElementSibling;
          if (details.style.maxHeight) {
            details.style.maxHeight = null;
          } else {
            details.style.maxHeight = details.scrollHeight + "px";
          }
        });
      }
    </script>
@stop