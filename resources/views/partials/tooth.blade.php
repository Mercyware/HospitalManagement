<div class="row">


    <div class="col-md-6">
        <?php
        $Image = "";
        ?>
        <h4>Upper Left Quadrant </h4>
        <table class="table table-responsive table-bordered">
            <thead>

            <tr>
                <?php
                $TeethPosition = 1; //Left Top
                for ($i = 8; $i >= 1; $i--) {

                ?>
                <td><a onclick="gettooth({{$TeethPosition}},{{$i}});"
                       class="btn-sm btn-primary "><span
                                class="fa fa-minus-circle"></span> </a>
                </td>

                <?php
                }
                ?>

            </tr>

            <tr>
                <?php

                for ($i = 8; $i >= 1; $i--) {


                $toothStatus = \Illuminate\Support\Facades\DB::table('teeth')
                    ->where('patient_id', '=', $patient->id)
                    ->where('tooth_position', '=', $TeethPosition)
                    ->where('tooth_number', '=', $i)
                    ->get();
                if (!$toothStatus->isEmpty()) { // If there is a Current Tooth Status
                    $PatientTooth = $toothStatus[0]->tooth_status;
                    $Tooth_Path = $toothStatus[0]->tooth_part;
                    $Part_Value = $toothStatus[0]->part_value;
                } else {
                    $PatientTooth = 0;
                    $Tooth_Path = 0;
                    $Part_Value = 0;
                }



                $ImageName = getToothStatusPhoto($PatientTooth, $i);

                if ($PatientTooth == 0 && $i > 3) {
                    $MapName = '#tooth' . $TeethPosition . $i;
                } else if ($PatientTooth == 0 && $i <= 3) {
                    $MapName = '#tooth2' . $TeethPosition . $i;
                } else {
                    $MapName = "";
                }
                ?>

                <th>
                    {{--<a href="" class="btn-sm btn-success "><span--}}
                    {{--class="fa fa-check"></span> </a>--}}
                    {{--<hr/>--}}

                    @if($i>=4)


                        <div class="parent">
                            <div id="imagePlace{{$TeethPosition.$i}}">

                                <img src="/Images/{{$ImageName}}" class="ParentImage"
                                     usemap="{{$MapName}}"/>
                            </div>

                            <div id="result{{$TeethPosition.$i}}">

                            </div>
                            <?php
                            if ($PatientTooth == 0) {
                                if (!$toothStatus->isEmpty()) {
                                    foreach ($toothStatus as $patientteeth) {
                                        $Status = $patientteeth->part_value;

                                        if ($patientteeth->tooth_part == "T") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'TopImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'T\');"/>';


                                        }
                                        if ($patientteeth->tooth_part == "B") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'BottomImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'B\');"/>';


                                        }

                                        if ($patientteeth->tooth_part == "C") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'CenterImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'C\');"/>';


                                        }
                                        if ($patientteeth->tooth_part == "L") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'LeftImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'L\');"/>';


                                        }

                                        if ($patientteeth->tooth_part == "R") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'RightImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'R\');"/>';


                                        }
                                    }
                                }
                            }
                            ?>

                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="BottomImage  SmalliseImage img-responsive"/>--}}
                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="RightImage SmalliseImage  img-responsive"/>--}}
                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="LeftImage  SmalliseImage img-responsive"/>--}}

                            {{--<img src="/Images/Hole.png" class="TopImage  SmalliseImage img-responsive"/>--}}
                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="CenterImage SmalliseImage  img-responsive"/>--}}


                        </div>

                        <map name="tooth{{$TeethPosition.$i}}" id="tooth">


                            <area alt="" title="Top" onclick="gett({{$TeethPosition}},{{$i}},'T');"
                                  shape="poly"
                                  coords="16,8,26,8,39,1,5,1"/>
                            <area alt="" title="Left" onclick="gett({{$TeethPosition}},{{$i}},'L');"
                                  shape="poly"
                                  coords="14,9,14,19,3,26,2,2"/>
                            <area alt="" title="Bottom"
                                  onclick="gett({{$TeethPosition}},{{$i}},'B');"
                                  shape="poly"
                                  coords="15,21,28,20,37,27,5,27"/>
                            <area alt="" title="Right"
                                  onclick="gett({{$TeethPosition}},{{$i}},'R');"
                                  shape="poly"
                                  coords="28,9,28,19,40,28,40,3"/>
                            <area alt="" title="Center"
                                  onclick="gett({{$TeethPosition}},{{$i}},'C');"
                                  shape="poly"
                                  coords="16,9,16,20,27,20,27,11,26,10,26,10,27,9"/>


                        </map>

                    @else
                        <div class="parent">
                            <div id="imagePlace{{$TeethPosition . $i}}">
                                <img src="/Images/{{$ImageName}}" class="ParentImage"
                                     usemap="{{$MapName}}"/>
                            </div>

                            <div id="result{{$TeethPosition . $i}}">


                                <?php
                                if ($PatientTooth == 0) {
                                    if (!$toothStatus->isEmpty()) {
                                        foreach ($toothStatus as $patientteeth) {
                                            $Status = $patientteeth->part_value;

                                            if ($patientteeth->tooth_part == "T") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'TopImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'T\');"/>';


                                            }
                                            if ($patientteeth->tooth_part == "B") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'BottomImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'B\');"/>';


                                            }

                                            if ($patientteeth->tooth_part == "C") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'CenterImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'C\');"/>';


                                            }
                                            if ($patientteeth->tooth_part == "L") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'LeftImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'L\');"/>';


                                            }

                                            if ($patientteeth->tooth_part == "R") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'RightImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'R\');"/>';


                                            }
                                        }
                                    }
                                }
                                ?>
                                {{--<img src="/Images/Hole.png"--}}
                                {{--class="BottomImage  SmalliseImage img-responsive"/>--}}
                                {{--<img src="/Images/Hole.png"--}}
                                {{--class="RightImage SmalliseImage  img-responsive"/>--}}
                                {{--<img src="/Images/Hole.png"--}}
                                {{--class="LeftImage  SmalliseImage img-responsive"/>--}}

                                {{--<img src="/Images/Hole.png" class="TopImage  SmalliseImage img-responsive"/>--}}
                            </div>

                        </div>

                        <map name="tooth2{{$TeethPosition.$i}}" id="tooth2">
                            <area alt="" title="Top" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'T');"
                                  coords="22,8,41,0,8,1,5,0"/>
                            <area alt="" title="Left" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'L');"
                                  coords="20,20,21,10,2,2,1,27"/>
                            <area alt="" title="Bottom" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'B');"
                                  coords="22,20,38,28,4,28"/>
                            <area alt="" title="Right" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'R');"
                                  coords="24,11,22,17,39,25,42,2"/>

                        </map>
                    @endif
                </th>

                <?php
                }
                ?>

            </tr>

            <tr>
            </thead>


            <tbody>
            <tr>
                <?php
                for ($i = 8; $i >= 1; $i--) {

                ?>
                <td> {{$i}} </td>

                <?php
                }
                ?>

            </tr>
            </tbody>

            <tfoot>

            <tr>
                <?php
                $TeethPosition = 3; //Left Down
                for ($i = 8; $i >= 1; $i--) {


                $toothStatus = \Illuminate\Support\Facades\DB::table('teeth')
                    ->where('patient_id', '=', $patient->id)
                    ->where('tooth_position', '=', $TeethPosition)
                    ->where('tooth_number', '=', $i)
                    ->get();
                if (!$toothStatus->isEmpty()) { // If there is a Current Tooth Status
                    $PatientTooth = $toothStatus[0]->tooth_status;
                    $Tooth_Path = $toothStatus[0]->tooth_part;
                    $Part_Value = $toothStatus[0]->part_value;
                } else {
                    $PatientTooth = 0;
                    $Tooth_Path = 0;
                    $Part_Value = 0;
                }



                $ImageName = getToothStatusPhoto($PatientTooth, $i);

                if ($PatientTooth == 0 && $i > 3) {
                    $MapName = '#tooth' . $TeethPosition . $i;
                } else if ($PatientTooth == 0 && $i <= 3) {
                    $MapName = '#tooth2' . $TeethPosition . $i;
                } else {
                    $MapName = "";
                }
                ?>

                <th>
                    {{--<a href="" class="btn-sm btn-success "><span--}}
                    {{--class="fa fa-check"></span> </a>--}}
                    {{--<hr/>--}}

                    @if($i>=4)


                        <div class="parent">
                            <div id="imagePlace{{$TeethPosition.$i}}">

                                <img src="/Images/{{$ImageName}}" class="ParentImage"
                                     usemap="{{$MapName}}"/>
                            </div>

                            <div id="result{{$TeethPosition.$i}}">

                            </div>
                            <?php
                            if ($PatientTooth == 0) {
                                if (!$toothStatus->isEmpty()) {
                                    foreach ($toothStatus as $patientteeth) {
                                        $Status = $patientteeth->part_value;

                                        if ($patientteeth->tooth_part == "T") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'TopImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'T\');"/>';


                                        }
                                        if ($patientteeth->tooth_part == "B") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'BottomImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'B\');"/>';


                                        }

                                        if ($patientteeth->tooth_part == "C") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'CenterImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'C\');"/>';


                                        }
                                        if ($patientteeth->tooth_part == "L") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'LeftImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'L\');"/>';


                                        }

                                        if ($patientteeth->tooth_part == "R") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'RightImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'R\');"/>';


                                        }
                                    }
                                }
                            }
                            ?>

                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="BottomImage  SmalliseImage img-responsive"/>--}}
                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="RightImage SmalliseImage  img-responsive"/>--}}
                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="LeftImage  SmalliseImage img-responsive"/>--}}

                            {{--<img src="/Images/Hole.png" class="TopImage  SmalliseImage img-responsive"/>--}}
                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="CenterImage SmalliseImage  img-responsive"/>--}}


                        </div>

                        <map name="tooth{{$TeethPosition.$i}}" id="tooth">


                            <area alt="" title="Top" onclick="gett({{$TeethPosition}},{{$i}},'T');"
                                  shape="poly"
                                  coords="16,8,26,8,39,1,5,1"/>
                            <area alt="" title="Left" onclick="gett({{$TeethPosition}},{{$i}},'L');"
                                  shape="poly"
                                  coords="14,9,14,19,3,26,2,2"/>
                            <area alt="" title="Bottom"
                                  onclick="gett({{$TeethPosition}},{{$i}},'B');"
                                  shape="poly"
                                  coords="15,21,28,20,37,27,5,27"/>
                            <area alt="" title="Right"
                                  onclick="gett({{$TeethPosition}},{{$i}},'R');"
                                  shape="poly"
                                  coords="28,9,28,19,40,28,40,3"/>
                            <area alt="" title="Center"
                                  onclick="gett({{$TeethPosition}},{{$i}},'C');"
                                  shape="poly"
                                  coords="16,9,16,20,27,20,27,11,26,10,26,10,27,9"/>


                        </map>

                    @else
                        <div class="parent">
                            <div id="imagePlace{{$TeethPosition . $i}}">
                                <img src="/Images/{{$ImageName}}" class="ParentImage"
                                     usemap="{{$MapName}}"/>
                            </div>

                            <div id="result{{$TeethPosition . $i}}">


                                <?php
                                if ($PatientTooth == 0) {
                                    if (!$toothStatus->isEmpty()) {
                                        foreach ($toothStatus as $patientteeth) {
                                            $Status = $patientteeth->part_value;

                                            if ($patientteeth->tooth_part == "T") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'TopImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'T\');"/>';


                                            }
                                            if ($patientteeth->tooth_part == "B") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'BottomImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'B\');"/>';


                                            }

                                            if ($patientteeth->tooth_part == "C") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'CenterImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'C\');"/>';


                                            }
                                            if ($patientteeth->tooth_part == "L") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'LeftImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'L\');"/>';


                                            }

                                            if ($patientteeth->tooth_part == "R") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'RightImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'R\');"/>';


                                            }
                                        }
                                    }
                                }
                                ?>
                                {{--<img src="/Images/Hole.png"--}}
                                {{--class="BottomImage  SmalliseImage img-responsive"/>--}}
                                {{--<img src="/Images/Hole.png"--}}
                                {{--class="RightImage SmalliseImage  img-responsive"/>--}}
                                {{--<img src="/Images/Hole.png"--}}
                                {{--class="LeftImage  SmalliseImage img-responsive"/>--}}

                                {{--<img src="/Images/Hole.png" class="TopImage  SmalliseImage img-responsive"/>--}}
                            </div>

                        </div>

                        <map name="tooth2{{$TeethPosition.$i}}" id="tooth2">
                            <area alt="" title="Top" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'T');"
                                  coords="22,8,41,0,8,1,5,0"/>
                            <area alt="" title="Left" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'L');"
                                  coords="20,20,21,10,2,2,1,27"/>
                            <area alt="" title="Bottom" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'B');"
                                  coords="22,20,38,28,4,28"/>
                            <area alt="" title="Right" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'R');"
                                  coords="24,11,22,17,39,25,42,2"/>

                        </map>
                    @endif
                </th>

                <?php
                }
                ?>

            </tr>

            <tr>
                <?php
                for ($i = 8; $i >= 1; $i--) {

                ?>
                <td><a onclick="gettooth({{$TeethPosition}},{{$i}});"
                       class="btn-sm btn-primary "><span
                                class="fa fa-minus-circle"></span> </a>
                </td>

                <?php
                }
                ?>

            </tr>

            </tfoot>


        </table>
        <h4>Lower Left Quadrant </h4>
    </div>

    <div class="col-md-6">
        <?php
        $Image = "";
        ?>
        <h4>Upper Right Quadrant </h4>
        <table class="table table-responsive table-bordered">
            <thead>

            <tr>
                <?php
                $TeethPosition = 2; //Left Top
                for ($i = 1; $i <= 8; $i++) {

                ?>
                <td><a onclick="gettooth({{$TeethPosition}},{{$i}});"
                       class="btn-sm btn-primary "><span
                                class="fa fa-minus-circle"></span> </a>
                </td>

                <?php
                }
                ?>

            </tr>

            <tr>
                <?php

                for ($i = 1; $i <= 8; $i++) {


                $toothStatus = \Illuminate\Support\Facades\DB::table('teeth')
                    ->where('patient_id', '=', $patient->id)
                    ->where('tooth_position', '=', $TeethPosition)
                    ->where('tooth_number', '=', $i)
                    ->get();
                if (!$toothStatus->isEmpty()) { // If there is a Current Tooth Status
                    $PatientTooth = $toothStatus[0]->tooth_status;
                    $Tooth_Path = $toothStatus[0]->tooth_part;
                    $Part_Value = $toothStatus[0]->part_value;
                } else {
                    $PatientTooth = 0;
                    $Tooth_Path = 0;
                    $Part_Value = 0;
                }



                $ImageName = getToothStatusPhoto($PatientTooth, $i);

                if ($PatientTooth == 0 && $i > 3) {
                    $MapName = '#tooth' . $TeethPosition . $i;
                } else if ($PatientTooth == 0 && $i <= 3) {
                    $MapName = '#tooth2' . $TeethPosition . $i;
                } else {
                    $MapName = "";
                }
                ?>

                <th>
                    {{--<a href="" class="btn-sm btn-success "><span--}}
                    {{--class="fa fa-check"></span> </a>--}}
                    {{--<hr/>--}}

                    @if($i>=4)


                        <div class="parent">
                            <div id="imagePlace{{$TeethPosition.$i}}">

                                <img src="/Images/{{$ImageName}}" class="ParentImage"
                                     usemap="{{$MapName}}"/>
                            </div>

                            <div id="result{{$TeethPosition.$i}}">

                            </div>
                            <?php
                            if ($PatientTooth == 0) {
                                if (!$toothStatus->isEmpty()) {
                                    foreach ($toothStatus as $patientteeth) {
                                        $Status = $patientteeth->part_value;

                                        if ($patientteeth->tooth_part == "T") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'TopImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'T\');"/>';


                                        }
                                        if ($patientteeth->tooth_part == "B") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'BottomImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'B\');"/>';


                                        }

                                        if ($patientteeth->tooth_part == "C") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'CenterImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'C\');"/>';


                                        }
                                        if ($patientteeth->tooth_part == "L") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'LeftImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'L\');"/>';


                                        }

                                        if ($patientteeth->tooth_part == "R") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'RightImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'R\');"/>';


                                        }
                                    }
                                }
                            }
                            ?>

                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="BottomImage  SmalliseImage img-responsive"/>--}}
                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="RightImage SmalliseImage  img-responsive"/>--}}
                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="LeftImage  SmalliseImage img-responsive"/>--}}

                            {{--<img src="/Images/Hole.png" class="TopImage  SmalliseImage img-responsive"/>--}}
                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="CenterImage SmalliseImage  img-responsive"/>--}}


                        </div>

                        <map name="tooth{{$TeethPosition.$i}}" id="tooth">


                            <area alt="" title="Top" onclick="gett({{$TeethPosition}},{{$i}},'T');"
                                  shape="poly"
                                  coords="16,8,26,8,39,1,5,1"/>
                            <area alt="" title="Left" onclick="gett({{$TeethPosition}},{{$i}},'L');"
                                  shape="poly"
                                  coords="14,9,14,19,3,26,2,2"/>
                            <area alt="" title="Bottom"
                                  onclick="gett({{$TeethPosition}},{{$i}},'B');"
                                  shape="poly"
                                  coords="15,21,28,20,37,27,5,27"/>
                            <area alt="" title="Right"
                                  onclick="gett({{$TeethPosition}},{{$i}},'R');"
                                  shape="poly"
                                  coords="28,9,28,19,40,28,40,3"/>
                            <area alt="" title="Center"
                                  onclick="gett({{$TeethPosition}},{{$i}},'C');"
                                  shape="poly"
                                  coords="16,9,16,20,27,20,27,11,26,10,26,10,27,9"/>


                        </map>

                    @else
                        <div class="parent">
                            <div id="imagePlace{{$TeethPosition . $i}}">
                                <img src="/Images/{{$ImageName}}" class="ParentImage"
                                     usemap="{{$MapName}}"/>
                            </div>

                            <div id="result{{$TeethPosition . $i}}">


                                <?php
                                if ($PatientTooth == 0) {
                                    if (!$toothStatus->isEmpty()) {
                                        foreach ($toothStatus as $patientteeth) {
                                            $Status = $patientteeth->part_value;

                                            if ($patientteeth->tooth_part == "T") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'TopImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'T\');"/>';


                                            }
                                            if ($patientteeth->tooth_part == "B") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'BottomImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'B\');"/>';


                                            }

                                            if ($patientteeth->tooth_part == "C") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'CenterImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'C\');"/>';


                                            }
                                            if ($patientteeth->tooth_part == "L") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'LeftImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'L\');"/>';


                                            }

                                            if ($patientteeth->tooth_part == "R") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'RightImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'R\');"/>';


                                            }
                                        }
                                    }
                                }
                                ?>
                                {{--<img src="/Images/Hole.png"--}}
                                {{--class="BottomImage  SmalliseImage img-responsive"/>--}}
                                {{--<img src="/Images/Hole.png"--}}
                                {{--class="RightImage SmalliseImage  img-responsive"/>--}}
                                {{--<img src="/Images/Hole.png"--}}
                                {{--class="LeftImage  SmalliseImage img-responsive"/>--}}

                                {{--<img src="/Images/Hole.png" class="TopImage  SmalliseImage img-responsive"/>--}}
                            </div>

                        </div>

                        <map name="tooth2{{$TeethPosition.$i}}" id="tooth2">
                            <area alt="" title="Top" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'T');"
                                  coords="22,8,41,0,8,1,5,0"/>
                            <area alt="" title="Left" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'L');"
                                  coords="20,20,21,10,2,2,1,27"/>
                            <area alt="" title="Bottom" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'B');"
                                  coords="22,20,38,28,4,28"/>
                            <area alt="" title="Right" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'R');"
                                  coords="24,11,22,17,39,25,42,2"/>

                        </map>
                    @endif
                </th>

                <?php
                }
                ?>

            </tr>

            <tr>
            </thead>


            <tbody>
            <tr>
                <?php
                for ($i = 1; $i <= 8; $i++) {

                ?>
                <td> {{$i}} </td>

                <?php
                }
                ?>

            </tr>
            </tbody>

            <tfoot>

            <tr>
                <?php
                $TeethPosition = 4; //Left Down
                for ($i = 8; $i >= 1; $i--) {


                $toothStatus = \Illuminate\Support\Facades\DB::table('teeth')
                    ->where('patient_id', '=', $patient->id)
                    ->where('tooth_position', '=', $TeethPosition)
                    ->where('tooth_number', '=', $i)
                    ->get();
                if (!$toothStatus->isEmpty()) { // If there is a Current Tooth Status
                    $PatientTooth = $toothStatus[0]->tooth_status;
                    $Tooth_Path = $toothStatus[0]->tooth_part;
                    $Part_Value = $toothStatus[0]->part_value;
                } else {
                    $PatientTooth = 0;
                    $Tooth_Path = 0;
                    $Part_Value = 0;
                }



                $ImageName = getToothStatusPhoto($PatientTooth, $i);

                if ($PatientTooth == 0 && $i > 3) {
                    $MapName = '#tooth' . $TeethPosition . $i;
                } else if ($PatientTooth == 0 && $i <= 3) {
                    $MapName = '#tooth2' . $TeethPosition . $i;
                } else {
                    $MapName = "";
                }
                ?>

                <th>
                    {{--<a href="" class="btn-sm btn-success "><span--}}
                    {{--class="fa fa-check"></span> </a>--}}
                    {{--<hr/>--}}

                    @if($i>=4)


                        <div class="parent">
                            <div id="imagePlace{{$TeethPosition.$i}}">

                                <img src="/Images/{{$ImageName}}" class="ParentImage"
                                     usemap="{{$MapName}}"/>
                            </div>

                            <div id="result{{$TeethPosition.$i}}">

                            </div>
                            <?php
                            if ($PatientTooth == 0) {
                                if (!$toothStatus->isEmpty()) {
                                    foreach ($toothStatus as $patientteeth) {
                                        $Status = $patientteeth->part_value;

                                        if ($patientteeth->tooth_part == "T") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'TopImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'T\');"/>';


                                        }
                                        if ($patientteeth->tooth_part == "B") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'BottomImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'B\');"/>';


                                        }

                                        if ($patientteeth->tooth_part == "C") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'CenterImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'C\');"/>';


                                        }
                                        if ($patientteeth->tooth_part == "L") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'LeftImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'L\');"/>';


                                        }

                                        if ($patientteeth->tooth_part == "R") {
                                            //This is the Top Value fro the Teach
                                            $Image = getPhotoName($Status);
                                            $Classname = 'RightImage';
                                            echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'R\');"/>';


                                        }
                                    }
                                }
                            }
                            ?>

                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="BottomImage  SmalliseImage img-responsive"/>--}}
                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="RightImage SmalliseImage  img-responsive"/>--}}
                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="LeftImage  SmalliseImage img-responsive"/>--}}

                            {{--<img src="/Images/Hole.png" class="TopImage  SmalliseImage img-responsive"/>--}}
                            {{--<img src="/Images/Hole.png"--}}
                            {{--class="CenterImage SmalliseImage  img-responsive"/>--}}


                        </div>

                        <map name="tooth{{$TeethPosition.$i}}" id="tooth">


                            <area alt="" title="Top" onclick="gett({{$TeethPosition}},{{$i}},'T');"
                                  shape="poly"
                                  coords="16,8,26,8,39,1,5,1"/>
                            <area alt="" title="Left" onclick="gett({{$TeethPosition}},{{$i}},'L');"
                                  shape="poly"
                                  coords="14,9,14,19,3,26,2,2"/>
                            <area alt="" title="Bottom"
                                  onclick="gett({{$TeethPosition}},{{$i}},'B');"
                                  shape="poly"
                                  coords="15,21,28,20,37,27,5,27"/>
                            <area alt="" title="Right"
                                  onclick="gett({{$TeethPosition}},{{$i}},'R');"
                                  shape="poly"
                                  coords="28,9,28,19,40,28,40,3"/>
                            <area alt="" title="Center"
                                  onclick="gett({{$TeethPosition}},{{$i}},'C');"
                                  shape="poly"
                                  coords="16,9,16,20,27,20,27,11,26,10,26,10,27,9"/>


                        </map>

                    @else
                        <div class="parent">
                            <div id="imagePlace{{$TeethPosition . $i}}">
                                <img src="/Images/{{$ImageName}}" class="ParentImage"
                                     usemap="{{$MapName}}"/>
                            </div>

                            <div id="result{{$TeethPosition . $i}}">


                                <?php
                                if ($PatientTooth == 0) {
                                    if (!$toothStatus->isEmpty()) {
                                        foreach ($toothStatus as $patientteeth) {
                                            $Status = $patientteeth->part_value;

                                            if ($patientteeth->tooth_part == "T") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'TopImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'T\');"/>';


                                            }
                                            if ($patientteeth->tooth_part == "B") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'BottomImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'B\');"/>';


                                            }

                                            if ($patientteeth->tooth_part == "C") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'CenterImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'C\');"/>';


                                            }
                                            if ($patientteeth->tooth_part == "L") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'LeftImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'L\');"/>';


                                            }

                                            if ($patientteeth->tooth_part == "R") {
                                                //This is the Top Value fro the Teach
                                                $Image = getPhotoName($Status);
                                                $Classname = 'RightImage';
                                                echo '<img src="/Images/' . $Image . '" class="' . $Classname . '  SmalliseImage img-responsive" onclick="gett(' . $TeethPosition . ',' . $i . ',\'R\');"/>';


                                            }
                                        }
                                    }
                                }
                                ?>
                                {{--<img src="/Images/Hole.png"--}}
                                {{--class="BottomImage  SmalliseImage img-responsive"/>--}}
                                {{--<img src="/Images/Hole.png"--}}
                                {{--class="RightImage SmalliseImage  img-responsive"/>--}}
                                {{--<img src="/Images/Hole.png"--}}
                                {{--class="LeftImage  SmalliseImage img-responsive"/>--}}

                                {{--<img src="/Images/Hole.png" class="TopImage  SmalliseImage img-responsive"/>--}}
                            </div>

                        </div>

                        <map name="tooth2{{$TeethPosition.$i}}" id="tooth2">
                            <area alt="" title="Top" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'T');"
                                  coords="22,8,41,0,8,1,5,0"/>
                            <area alt="" title="Left" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'L');"
                                  coords="20,20,21,10,2,2,1,27"/>
                            <area alt="" title="Bottom" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'B');"
                                  coords="22,20,38,28,4,28"/>
                            <area alt="" title="Right" shape="poly"
                                  onclick="gett({{$TeethPosition}},{{$i}},'R');"
                                  coords="24,11,22,17,39,25,42,2"/>

                        </map>
                    @endif
                </th>

                <?php
                }
                ?>

            </tr>

            <tr>
                <?php
                for ($i = 1; $i <= 8; $i++) {

                ?>
                <td><a onclick="gettooth({{$TeethPosition}},{{$i}});"
                       class="btn-sm btn-primary "><span
                                class="fa fa-minus-circle"></span> </a>
                </td>

                <?php
                }
                ?>

            </tr>

            </tfoot>


        </table>
        <h4>Lower Right Quadrant</h4>
    </div>

</div>