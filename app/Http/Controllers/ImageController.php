<?hh // strict
/**
 * ImageController.php file.
 * Created at 11.03.2015
 *
 * @author Meelis-Marius Pinka <meelis@c0de.ee>
 * @copyright Copyright &copy; 2015 Code OÜ
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Utils\Utils;
use Illuminate\Support\Collection;
use Response;
use Illuminate\Http\Request;
use App\Services\IFlickrRepository;

class ImageController extends Controller {

    protected IFlickrRepository $repo;

    public function __construct()
    {
        $this->repo = Utils::getFlickrRepository();
    }

    /**
     * Retrieves images from repository
     * @param Request $req
     */
	public function store(Request $req)
	{
        $tags = $req->get('tags');

        if (!$tags) {
            return;
        }

        try {
            /** @var $images Collection*/
            $images = $this->repo->getImagesByTags($tags);

            return Response::json(array(
                'error' => false,
                'images' => $images->toArray(),
                'cached' => $this->repo->isCached(),
                200
            ));

        } catch (\Exception $e) {
            return Response::json(array(
                'error' => $e->getMessage(),
                'images' => array(),
                'cached' => false,
                400
            ));
        }
	}

}
