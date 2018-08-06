            <table>
                        <thead>
                                        <tr>
                                            <th>عنوان کلاس</th>
                                            <th>نام استاد</th>
                                            <th>تاریخ برگزاری جلسه</th>
                                            <th>نام</th>
                                            <th>نام خانوادگی</th>
                                            <th>شماره کارت سبز</th>
                                            <th>وضعیت حضور</th>
                                            <th>تأخیر (به دقیقه)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($class->sessions as $session)


                                        @foreach($session->attendances as $attendance)
                                        <tr class="odd gradeX">
                                            <td>{{$class->topic}}</td>
                                            <td>{{$class->teacher->first_name}} {{$class->teacher->last_name}}</td>
                                            <td>{{$session->date}}</td>
                                            <td>{{$attendance->student->first_name}}</td>
                                            <td>{{$attendance->student->last_name}}</td>
                                            <td>{{$attendance->student->green_cart_number}}</td>
                                            <td>@if($attendance->presentation_status){{'حاضر'}}@else {{'غایب'}} @endif</td>
                                            <td>{{$attendance->delay_time}}</td>
                                        </tr>
                                        @endforeach
                                    @endforeach 
                                        
                                    </tbody>
                                </table>