@extends('layouts.guest')

@section('content')
    @include('partials.guest.header')

<div class="container">
  <div class="col-lg-12 col-md-12" style="margin-top: 3%">

   <form method="post" action="route('contactUs.store')">
    <div class="col-lg-6 col-md-6 col-sm-6 topgap">

    <center style="font-family: 'Lobster', cursive; margin-top: -4%;">
        <h1>Contact Us</h1>
    </center> <br>

    <table width="100%">
        {{ csrf_field() }}
      <tr>
        <td>
            <label for="firstName">First Name:</label>
            <input type="text" class="form-control col-lg-3 col-md-3 col-sm-3 col-xs-3" placeholder="Please Enter your First Name" ng-model="first_name" name="firstName" required/>
        </td>
        <td>
            <label for="lastName">Last Name:</label>
            <input type="text" class="form-control col-lg-3 col-md-3 col-sm-3 col-xs-3" placeholder="Please Enter your Last Name" ng-model="last_name" name="lastName" required/>
        </td>
      </tr>
      
      <tr>
        <td>
            <label for="email">Email ID:</label>
            <input type="email" class="form-control col-lg-3 col-md-3 col-sm-3 col-xs-3" placeholder="Please enter your Email ID" ng-model="email" name="email" required/>
        </td>
        <td>
            <label for="subject">Subject:</label>
            <input type="text" class="form-control col-lg-3 col-md-3 col-sm-3 col-xs-3" placeholder="Please enter your Subject"  ng-model="place" name="subject" required/>
        </td>
      </tr>

      <tr>
        <td colspan="2"> <br>
            <label for="message">Message:</label>
            <textarea class="form-control" name="message" rows="5" id="message" ng-model="message"></textarea>
        </td>
      </tr>
    </table>
    
    <button type="submit" class="btn btn-info btn-block buttonSubmit" style="border-radius: 9px;">Kirim Pesan</button>
    </div>
   </form>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="paper">
          <div class="lines">
            <div class="Lettertext" spellcheck="false">
              Hello Customers Ter-cinta, <br /><br />
              Selamat datang di form Contact-Us Getbus. 
              <br/><br/>
              Kami adalah sebuah strat up baru yang bergerak dibidang transportasi.
              <br/><br/>
              Jika ada kendala yang tidak anda mengerti terkait dengan aplikasi jasa penyewaan bus kami. Silahkan kirimkan pertanyaan anda melalui contact form di samping ini.
              <br/><br />
              Pertanyaan yang anda kirim, akan kami jawab secepat dan sebaik mungkin
              <br/><br/>
              Thanks and Regards,<p> Getbus beginner Team!
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<br><br><br><br><br>
@endsection
