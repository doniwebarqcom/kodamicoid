<?php 

/**
 * [simpanan_wajib description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function simpanan_wajib($id)
{
	$simpanan_wajib = \Kodami\Models\Mysql\Deposit::where('user_id', $id)->where('type', 5)->where('status', 3)->sum('nominal'); 

	return $simpanan_wajib;
}

/**
 * [simpanan_pokok description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function simpanan_pokok($id)
{
	$simpanan_pokok = \Kodami\Models\Mysql\Deposit::where('user_id', $id)->where('type', 3)->where('status', 3)->sum('nominal'); 

	return $simpanan_pokok;
}

/**
 * [cek_tagihan description]
 * @return [type] [description]
 */
function simpanan_sukarela($id)
{
	$simpanan_sukarela = \Kodami\Models\Mysql\Deposit::where('user_id', $id)->where('type', 4)->where('status', 3)->sum('nominal'); 

	return $simpanan_sukarela;
}

/**
 * [get_setting description]
 * @param  [type] $field [description]
 * @return [type]        [description]
 */
function get_setting($field)
{
	$item = \App\Setting::where('field', $field)->first();

	if($item)
	{
		return $item->value;
	}

	return;
}

/**
 * [get_provinsi description]
 * @return [type] [description]
 */
function get_provinsi()
{
   return \App\Provinsi::orderBy('nama', 'ASC')->get();
}
	
/**
 * [get_kabupaten_by_provinsi description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function get_kabupaten_by_provinsi($id)
{
	return \App\Kabupaten::where('id_prov', $id)->get();
}

/**
 * [get_kecamatan_by_kabupaten description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function get_kecamatan_by_kabupaten($id)
{
	return \App\Kecamatan::where('id_kab', $id)->get();
}

/**
 * [get_kelurahan_by_kecamatan description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function get_kelurahan_by_kecamatan($id)
{
	return \App\Kelurahan::where('id_kec', $id)->get();
}

?>