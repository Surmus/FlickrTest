<?hh // strict
/**
 * FlickrImage.php file.
 * Created at 11.03.2015
 *
 * @author Meelis-Marius Pinka <meelis@c0de.ee>
 * @copyright Copyright &copy; 2015 Code OÜ
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlickrImage extends Model {

    protected string $title;

    protected string $imageUrl;

    protected string $shareLink;
}
