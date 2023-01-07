<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\CallAssign;
use App\Models\CallStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllocateController extends Controller
{
    public function allocateEngineer(Request $request)
    {
      $callAssign =  new CallAssign();

      $callAssign->callid = $request->callid;
      $callAssign->userid = $request->engineer;
      $callAssign->assigneddate = Carbon::now();
      $callAssign->assignedActive =true;
      $callAssign->level =1;
      $callAssign->assignedby =Auth::user()->id;
      $callAssign->save();

      $status = New CallStatus();
      $status->callid = $request->callid;
      $status->status = 'Allocated';
      $status->type = 'normal';
      $status->mode = 1;
      $status->level = CallStatus::where('callid', $callAssign->callid)->count()+1;
      $status->visitdate = Carbon::parse($request->visitdate);
      $status->addedby = Auth::user()->id;
      $status->save();

      return $callAssign;
    }
}
