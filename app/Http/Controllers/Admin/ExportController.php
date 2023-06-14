<?php

namespace App\Http\Controllers\Admin;

use App\Models\ConsolOborotYear;
use App\Models\ConsolYear;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ConsolidatedExport;
use App\Exports\ConsolidateOborotiExport;

use Illuminate\Http\Request;

use App\Models\Organization;
use App\Models\User;

use App\Models\Consolidated;
use App\Models\ConsolidateOboroti;
use Prologue\Alerts\Facades\Alert;

class ExportController
{
    public function export_shaxmatka()
    {
        return Excel::download(new ConsolidatedExport, 'shaxmatka_balance.xlsx');
    }

    public function export_oboroti_shaxmatka()
    {
        return Excel::download(new ConsolidateOborotiExport, 'shaxmatka_oboroti.xlsx');
    }

    public function export_shaxmatka_view()
    {
        $organizations = Organization::with('send_orgs')->get();
        $allorganizations = Organization::with('send_orgs')->get();

        foreach ($organizations as $item) {
            foreach ($allorganizations as $org) {
                $con = $item->send_orgs->where('rec_id', '!=', null)->where('rec_id', $org->user_id);
                $conback = $org->send_orgs->where('rec_id', '!=', null)->where('rec_id', $item->user_id);

                $t = true;
                $z = true;
                $x = 0;
                $y = 0;

                if ($con->count() >= 1) {
                    $con = $con->first();
                    $x = (int) $con->ex_06 + (int) $con->ex_09 + (int) $con->ex_40 + (int) $con->ex_41 +
                        (int) $con->ex_43 + (int) $con->ex_46 + (int) $con->ex_48 + (int) $con->ex_58 +
                        (int) $con->ex_60 + (int) $con->ex_61 + (int) $con->ex_63 + (int) $con->ex_66 + (int) $con->ex_68 + (int) $con->ex_69 + (int) $con->ex_78 + (int) $con->ex_79 + (int) $con->ex_83;
                } else
                    $t = false;

                if ($conback->count() >= 1) {
                    $conback = $conback->first();
                    $y = (int) $conback->ex_06 + (int) $conback->ex_09 + (int) $conback->ex_40 + (int) $conback->ex_41 +
                        (int) $conback->ex_43 + (int) $conback->ex_46 + (int) $conback->ex_48 + (int) $conback->ex_58 +
                        (int) $conback->ex_60 + (int) $conback->ex_61 + (int) $conback->ex_63 + (int) $conback->ex_66 + (int) $conback->ex_68 + (int) $conback->ex_69 + (int) $conback->ex_78 + (int) $conback->ex_79 + (int) $conback->ex_83;
                } else
                    $z = false;

                if ($t == false && $z == false) {
                    $a[$item->id][$org->id] = '-';
                } else
                    $a[$item->id][$org->id] = $x + $y;

            }
        }

        return view('backpack::shaxmatka', [
            'organizations' => $organizations,
            'a' => $a
        ]);
    }

    public function export_shaxmatka_oborot_view()
    {
        $organizations = Organization::with('send_oborot_orgs')->get();
        $allorganizations = Organization::with('send_oborot_orgs')->get();

        foreach ($organizations as $item) {
            foreach ($allorganizations as $org) {
                $con = $item->send_oborot_orgs->whereNotNull('rec_id')->where('rec_id', $org->user_id);
                $conback = $org->send_oborot_orgs->whereNotNull('rec_id')->where('rec_id', $item->user_id);

                $t = true;
                $z = true;
                $x = 0;
                $y = 0;

                if ($con->count() >= 1) {
                    $con = $con->first();

                    $x = (int) $con->postup_os + (int) $con->postup_os_ot_lizing + (int) $con->postup_tms + (int) $con->postup_zatrat + (int) $con->pered_os_v_lizing + (int) $con->pered_os_cher_shet
                        + (int) $con->poluch_os_cher_shet + (int) $con->pered_tms + (int) $con->poluch_tms + (int) $con->pered_saldo_nalog + (int) $con->pol_saldo_nalog
                        + (int) $con->pered_prochix + (int) $con->postup_prochix + (int) $con->viruchka_ot_real + (int) $con->doxod_ot_vib_os + (int) $con->doxod_ot_vib_prochix + (int) $con->proch_oper_doxod
                        + (int) $con->rasxodi_perioda + (int) $con->doxodi_vide_divid + (int) $con->divid_obyav + (int) $con->doxodi_vide_prosent + (int) $con->rasxodi_vide_prosent
                        + (int) $con->doxodi_ot_finar + (int) $con->rasxodi_vide_prosent_po_finar + (int) $con->doxodi_po_kurs + (int) $con->rasxodi_po_kurs + (int) $con->prochi_daxodi_ot_fin + (int) $con->prochi_rasxodi_ot_fin
                        + (int) $con->nds_oplate + (int) $con->nds_zashet + (int) $con->aksiz_uplate + (int) $con->poluch_deneg + (int) $con->uplach_deneg + (int) $con->vzaimozashet
                        + (int) $con->rashet_tret_litsam + (int) $con->prochie;

                } else
                    $t = false;

                if ($conback->count() >= 1) {
                    $conback = $conback->first();

                    $y = (int) $conback->postup_os + (int) $conback->postup_os_ot_lizing + (int) $conback->postup_tms + (int) $conback->postup_zatrat + (int) $conback->pered_os_v_lizing + (int) $conback->pered_os_cher_shet
                        + (int) $conback->poluch_os_cher_shet + (int) $conback->pered_tms + (int) $conback->poluch_tms + (int) $conback->pered_saldo_nalog + (int) $conback->pol_saldo_nalog
                        + (int) $conback->pered_prochix + (int) $conback->postup_prochix + (int) $conback->viruchka_ot_real + (int) $conback->doxod_ot_vib_os + (int) $conback->doxod_ot_vib_prochix + (int) $conback->proch_oper_doxod
                        + (int) $conback->rasxodi_perioda + (int) $conback->doxodi_vide_divid + (int) $conback->divid_obyav + (int) $conback->doxodi_vide_prosent + (int) $conback->rasxodi_vide_prosent
                        + (int) $conback->doxodi_ot_finar + (int) $conback->rasxodi_vide_prosent_po_finar + (int) $conback->doxodi_po_kurs + (int) $conback->rasxodi_po_kurs + (int) $conback->prochi_daxodi_ot_fin + (int) $conback->prochi_rasxodi_ot_fin
                        + (int) $conback->nds_oplate + (int) $conback->nds_zashet + (int) $conback->aksiz_uplate + (int) $conback->poluch_deneg + (int) $conback->uplach_deneg + (int) $conback->vzaimozashet
                        + (int) $conback->rashet_tret_litsam + (int) $conback->prochie;
                } else
                    $z = false;

                if ($t == true && $z == true) {
                    $a[$item->id][$org->id] = '-';
                } else
                    $a[$item->id][$org->id] = $x + $y;

            }
        }

        return view('backpack::shaxmatka', [
            'organizations' => $organizations,
            'a' => $a
        ]);
    }

    public function update_balance()
    {
        $year = ConsolYear::where('status', false)->first()->year_consol;

        $cons = Consolidated::where('ex_year', $year)->where('send_id', backpack_user()->id)->get();

        foreach ($cons as $item) {
            if (!$item->rec_id) {
                $org = Organization::where('inn', $item->rec_inn)->where('name', $item->rec_name)->first();

                if ($org) {
                    if ($org->user_id) {

                        $item->rec_id = $org->user_id;
                        $item->save();

                        $rec_con = Consolidated::where('ex_year', $year)
                            ->where('send_id', $item->rec_id)
                            ->where('rec_id', backpack_user()->id)
                            ->first();

                        if ($rec_con) {
                            if ($item->allResult() == (-1) * $rec_con->allResult())
                                $item->status = 3;
                            else {
                                $item->status = 4;
                                $item->result_a = $item->allResult();
                                $item->result_b = $rec_con->allResult();
                            }
                        } else {
                            $item->status = 5;
                            $item->result_a = $item->allResult();
                            $item->result_b = null;
                        }
                    } else
                        $item->status = 2;

                } else
                    $item->status = 2;
            } else {
                $rec_con = Consolidated::where('ex_year', $year)
                    ->where('send_id', $item->rec_id)
                    ->where('rec_id', backpack_user()->id)
                    ->first();

                if ($rec_con) {
                    if ($item->allResult() == (-1) * $rec_con->allResult())
                        $item->status = 3;
                    else {
                        $item->status = 4;
                        $item->result_a = $item->allResult();
                        $item->result_b = $rec_con->allResult();
                    }
                } else {
                    $item->status = 5;
                    $item->result_a = $item->allResult();
                    $item->result_b = null;
                }

            }

            $item->save();
        }

        Alert::success('Successfully Updated!')->flash();
        return back();
    }

    public function all_update_balance()
    {
        $year = ConsolYear::where('status', false)->first()->year_consol;
        $cons = Consolidated::where('ex_year', $year)->get();

        foreach ($cons as $item) {
            if (!$item->rec_id) {
                $org = Organization::where('ex_year', $year)
                    ->where('inn', $item->rec_inn)
                    ->where('name', $item->rec_name)
                    ->first();

                if ($org) {
                    if ($org->user_id) {

                        $item->rec_id = $org->user_id;
                        $item->save();

                        $rec_con = Consolidated::where('ex_year', $year)->where('send_id', $item->rec_id)->where('rec_id', $item->send_id)->first();
                        if ($rec_con) {
                            if ($item->allResult() == (-1) * $rec_con->allResult())
                                $item->status = 3;
                            else {
                                $item->status = 4;
                                $item->result_a = $item->allResult();
                                $item->result_b = $rec_con->allResult();
                            }
                        } else {
                            $item->status = 5;
                            $item->result_a = $item->allResult();
                            $item->result_b = null;
                        }
                    } else
                        $item->status = 2;

                } else
                    $item->status = 2;
            } else {
                $rec_con = Consolidated::where('ex_year', $year)
                    ->where('send_id', $item->rec_id)
                    ->where('rec_id', $item->send_id)
                    ->first();

                if ($rec_con) {
                    if ($item->allResult() == (-1) * $rec_con->allResult())
                        $item->status = 3;
                    else {
                        $item->status = 4;
                        $item->result_a = $item->allResult();
                        $item->result_b = $rec_con->allResult();
                    }
                } else {
                    $item->status = 5;
                    $item->result_a = $item->allResult();
                    $item->result_b = null;
                }
            }

            $item->save();
        }

        Alert::success('Successfully Updated!')->flash();
        return back();
    }

    public function update_oboroti()
    {
        $year_balance = ConsolYear::where('status', false)->first()->year_consol;
        $year = ConsolOborotYear::where('status', false)->first()->year_consol;

        $cons = ConsolidateOboroti::where('ex_year', $year)->where('send_id', backpack_user()->id)->get();

        foreach ($cons as $item) {
            if (!$item->rec_id) {
                $org = Organization::where('inn', $item->rec_inn)->where('name', $item->rec_name)->first();
                if ($org) {

                    if ($org->user_id) {
                        $item->rec_id = $org->user_id;
                        $item->save();

                        $saldo = Consolidated::where('ex_year', $year_balance)->where('send_id', $item->send_id)->where('rec_id', $item->rec_id)->first();
                        if ($saldo)
                            $sal = $saldo->allResult();
                        else
                            $sal = 0;

                        if ((int) $sal == (int) $item->saldo_start) {
                            $rec_con = ConsolidateOboroti::where('ex_year', $year)->where('send_id', $item->rec_id)->where('rec_id', backpack_user()->id)->first();

                            if ($rec_con) {
                                if ($item->allResult() == (-1) * $rec_con->allResult())
                                    $item->status = 3;
                                else {
                                    $item->status = 4;
                                    $item->result_a = $item->allResult();
                                    $item->result_b = $rec_con->allResult();
                                }
                            } else {
                                $item->status = 5;
                                $item->result_a = $item->allResult();
                                $item->result_b = null;
                            }

                        } else
                            $item->status = 6;
                    } else
                        $item->status = 2;

                } else
                    $item->status = 2;
            } else {
                $saldo = Consolidated::where('ex_year', $year_balance)->where('send_id', $item->send_id)->where('rec_id', $item->rec_id)->first();
                if ($saldo)
                    $sal = $saldo->allResult();
                else
                    $sal = 0;

                if ((int) $sal == (int) $item->saldo_start) {

                    $rec_con = ConsolidateOboroti::where('ex_year', $year)->where('send_id', $item->rec_id)->where('rec_id', backpack_user()->id)->first();
                    if ($rec_con) {
                        if ($item->allResult() == (-1) * $rec_con->allResult())
                            $item->status = 3;
                        else {
                            $item->status = 4;
                            $item->result_a = $item->allResult();
                            $item->result_b = $rec_con->allResult();
                        }
                    } else {
                        $item->status = 5;
                        $item->result_a = $item->allResult();
                        $item->result_b = null;
                    }

                } else
                    $item->status = 6;

            }

            $item->save();
        }

        Alert::success('Successfully Updated!')->flash();
        return back();
    }

    public function all_update_oboroti()
    {
        $year_balance = ConsolYear::where('status', false)->first()->year_consol;
        $year = ConsolOborotYear::where('status', false)->first()->year_consol;
        $cons = ConsolidateOboroti::where('ex_year', $year)->get();

        foreach ($cons as $item) {
            if (!$item->rec_id) {
                $org = Organization::where('inn', $item->rec_inn)->where('name', $item->rec_name)->first();
                if ($org) {

                    if ($org->user_id) {
                        $item->rec_id = $org->user_id;

                        $saldo = Consolidated::where('ex_year', $year_balance)->where('send_id', $item->send_id)->where('rec_id', $item->rec_id)->first();
                        if ($saldo)
                            $sal = $saldo->allResult();
                        else
                            $sal = 0;

                        if ((int) $sal == (int) $item->saldo_start) {
                            $rec_con = ConsolidateOboroti::where('ex_year', $year)->where('send_id', $item->rec_id)->where('rec_id', $item->send_id)->first();

                            if ($rec_con) {
                                if ($item->allResult() == (-1) * $rec_con->allResult())
                                    $item->status = 3;
                                else {
                                    $item->status = 4;
                                    $item->result_a = $item->allResult();
                                    $item->result_b = $rec_con->allResult();
                                }
                            } else {
                                $item->status = 4;
                                $item->result_a = $item->allResult();
                                $item->result_b = null;
                            }

                        } else
                            $item->status = 6;
                    } else
                        $item->status = 2;

                } else
                    $item->status = 2;
            } else {
                $saldo = Consolidated::where('ex_year', $year_balance)->where('send_id', $item->send_id)->where('rec_id', $item->rec_id)->first();
                if ($saldo)
                    $sal = $saldo->allResult();
                else
                    $sal = 0;

                if ((int) $sal == (int) $item->saldo_start) {

                    $rec_con = ConsolidateOboroti::where('ex_year', $year)->where('send_id', $item->rec_id)->where('rec_id', $item->send_id)->first();

                    if ($rec_con) {
                        if ($item->allResult() == (-1) * $rec_con->allResult())
                            $item->status = 3;
                        else {
                            $item->status = 4;
                            $item->result_a = $item->allResult();
                            $item->result_b = $rec_con->allResult();
                        }
                    } else {
                        $item->status = 5;
                        $item->result_a = $item->allResult();
                        $item->result_b = null;
                    }

                } else
                    $item->status = 6;

            }

            $item->save();
        }

        Alert::success('Successfully Updated!')->flash();
        return back();
    }

    public function control()
    {
        //    $organizations = Organization::get();

        //    foreach($organizations as $item)
        //    {
        //         $user = new User();
        //         $user->name = $item->name;
        //         $user->email = 'user'.$item->id.'@gmail.com';
        //         $user->password = bcrypt('123');
        //         $user->save();

        //         $item->user_id = $user->id;
        //         $item->save();
        //    }

        //     return back();
    }

    public function control_org()
    {
        $organizations = Organization::get();

        foreach ($organizations as $item) {
            $item->user_id = null;
            $item->save();
        }

        return back();
    }

}