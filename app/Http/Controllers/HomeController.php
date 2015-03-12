<?hh
/**
 * HomeController.php file.
 * Created at 11.03.2015
 *
 * @author Meelis-Marius Pinka <meelis@c0de.ee>
 * @copyright Copyright &copy; 2015 Code OÜ
 */

namespace App\Http\Controllers;

class HomeController extends Controller {

	/**
	 * Show the tags search page
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}

}
