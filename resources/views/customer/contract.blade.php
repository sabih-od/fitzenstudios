@extends('layouts.customer')
@section('page-title')
Contract
@endsection

@section('style')
 <style>
     #client_signature_preview{
         display: none;
     }
    
 </style>
@endsection

@section('content')
<main>
   
    <div class="content-wrap">
        <div class="row">
            <div class="col-md-6">
                <h2 class="secHeading">Personal Training Contract</h2>
            </div>
        </div>
        <div class="profile-wrap">
            <form class="contractForm" method="POST" action="{{ url('customer/submit-contract') }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <p>Personal Training Contract This Personal Training Contract (“Contract”) is entered on <input
                            type="text" class="d-inline form-control" name="field1" required> ( “<strong>Effective Date</strong>”),
                        by and between  Fitzen.Studio (Fitzen) , Coimbatore, Tamil Nadu, India and <input type="text" class="d-inline form-control" name="field2" required> with an address of <input
                            type="text" class="d-inline form-control w-50" name="field3" required> ,(“Client”), collectively the “Parties.”
                    </p>

                </div>
                <ol>
                    <li>
                        <p>
                            <strong>Terms and Conditions</strong> The parties agree to the following terms and conditions:
                        </p>
                        <ul>
                            <li>
                                <p>Client is engaging Fitzen.Studio for personal training services to be provided by Fitzen’s Trainer(s).
                                </p>
                            </li>
                            <li>
                                <p> Personal Training sessions will last 60 minutes.</p>
                            </li>
                            <li>
                                <p>Trainer will create an exercise program geared to Client's fitness level and experience in order to meet Client's objectives.
                                </p>
                            </li>
                            <li>
                                <p>Trainer will be assigned to Client by Fitzen and is subject to change at any time. Client may request a new Trainer and Fitzen will make every effort to accommodate if circumstances allow.
                                </p>
                            </li>
                            <li>
                                <p>Client agrees to sign the attached Personal Training Liability Waiver.</p>
                            </li>
                            <li>
                                <p>Client agrees to inform Fitzen and Trainer of any and all conditions, medical or otherwise, that may affect his/her ability to participate in Training Sessions.
                                </p>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <p>
                            <strong>Training Sessions</strong>. Training Sessions may include, but are not limited to, the following activities: testing of physical fitness; exercise; aerobics and aerobic conditioning; cardiovascular training; boxing; weight lifting and and stretching.
                        </p>
                    </li>
                    <li>
                        <p><strong>Training Package and Payments.</strong> The Client is purchasing
                            Client shall purchase 12 Training Sessions, to be completed within 5 weeks from the start of training at INR 12,000 plus applicable taxes.
                        </p>
                    </li>
                    <li>
                        <p>
                            <strong> Cancellation and Compensation of Sessions.</strong> No more than two missed sessions will be allowed to be compensated. The said two sessions will be carried forward for a maximum of one week from the end of the fourth week. If the Client doesn't avail of the missed sessions within this time frame , they stand to be forfeited. If Client wishes to cancel a session he/she will have to give a Twelve(12 ) hour notice of any necessary cancellation of a scheduled Training Session. Failure to provide Twelve (12) hour notice shall result in Client being charged the full rate for the cancelled/missed Training Session. Fitzen and its Trainer(s) will also endeavour to provide Client Twelve (12) hour notice of any scheduled Training Session that may need to be cancelled. The above twelve hour limitation shall not be applicable in case of Force Majeure.
                        </p>
                    </li>
                    <li>
                        <p>
                            <strong>Indemnity.</strong> As mentioned in point (e) of the Terms and Conditions of this Contract, the Client agrees to indemnify and hold harmless Fitzen and its Trainer(s) for any injuries, illnesses, and the like experienced as a result of Client's Training Sessions.
                        </p>
                    </li>
                    <li>
                        <p>
                            <strong>Duration and Termination.</strong> This contract will be understood to be renewed month on month until a notice of cancellation is given. Either Party may terminate this Contract by providing fifteen (15) days prior written notice to the other party. In the event of termination by either Party, Fitzen shall refund Client all monies paid for any unused Training Sessions.
                        </p>
                    </li>
                    <li>
                        <p>
                            <strong>Warranties.</strong> While Fitzen and its Trainer(s) fully believe exercise, specifically exercised personalized to Client, is beneficial to Client's health and wellness, Fitzen and its Trainer(s) cannot guarantee the results of Training Sessions. 3 Fitzen and its Trainer's make no representations and/or warranties that Client will lose weight, gain muscle mass, be able to engage in any specific physical and/or athletic activity, or will attain any other particular and/or specific results. Fitzen and its Trainer(s) strongly encourage Client to follow a healthy diet in conjunction with personal training and continued exercise.
                        </p>
                    </li>
                    <li>
                        <p>
                            <strong>Entire Agreement.</strong> This document reflects the entire agreement between the Parties and reflects a complete understanding of the Parties with respect to the subject matter. This Contract supersedes all prior written and oral representations. The Contract may not be amended, altered or supplemented except in writing signed by both Fitzen and Client. Arbitration,
                        </p>
                    </li>
                    <li>
                        <p>
                            <strong>Dispute Resolution and Legal Fees.</strong> In the event of a dispute arising out of this Contract that cannot be resolved by mutual agreement, the Parties agree to engage in mediation. If the matter cannot be resolved through mediation, and legal action ensues, the successful party will be entitled to its legal fees, including, but not limited to its attorney's fees. Choice of Law. The Contract shall be subject to and construed in accordance with the laws of India. 
                        </p>
                    </li>
                   
                <p>BY SIGNING BELOW, THE CLIENT ACKNOWLEDGES HAVING READ AND UNDERSTOOD THIS CONTRACT AND THAT THE CLIENT IS SATISFIED WITH THE TERMS AND CONDITIONS CONTAINED IN THIS CONTRACT. The Parties agree to the terms and conditions set forth above as demonstrated by their signatures as follows:</p>
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p><strong>Company</strong></p>
                        <div class="form-group">
                            {{-- <label for="">Signed:</label> --}}
                            {{-- <input type="file" class="form-control" name="company_signature" id="company_signature"> --}}
                            <img id="company_signature_preview" src="{{ asset('assets/images/signature.png') }}" alt="your image" />
                        </div>
                     
                        <div class="form-group">
                            <label for="">BY:</label>
                            <input type="text" class="form-control" name="company_name" value="Admin" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Date:</label>
                            <input type="date" class="form-control" name="company_date" value="{{ date('Y-m-d') }}" readonly>
                        </div>
                      
                    </div>
                    <div class="col-md-6">
                        <p><strong>Client</strong></p>

                        <div class="form-group">
                            <label for="">Signed:</label>
                            <input type="file" class="form-control" id="client_signature"  name="client_siganture" required>
                            <img id="client_signature_preview" src="#" alt="your image"  height= "115px" width= "120px" />
                        </div>
                      
                        <div class="form-group">
                            <label for="">By:</label>
                            <input type="text" class="form-control" name="client_name" required  value="{{ AUth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="">Date:</label>
                            <input type="date" class="form-control" name="client_date" value="{{ date('Y-m-d') }}" readonly>
                        </div>
                     
                    </div>
                    <div class="col-12">
                        <button class="btnStyle" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@section('js')
    <script type="text/javascript">
        function clientSignature(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#client_signature_preview').show();
                    $('#client_signature_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#client_signature").change(function(){
            clientSignature(this);
        });

        function companySignature(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#company_signature_preview').show();
                    $('#company_signature_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#company_signature").change(function(){
            companySignature(this);
        });


        company_signature_preview
    </script>
@endsection
