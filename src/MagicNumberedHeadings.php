<?php
/**
 * @copyright Copyright © 2022, Zoran Dori.
 * @license GPL-2.0-or-later
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, version 2
 * of the License.
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * See the GNU General Public License for more details.
 */

/**
 * This extension realizes a new MagicWord __NUMBEREDHEADINGS__.
 * If an article contains this MagicWord, numbering of the
 * headings is performed regardless of the user preference setting.
 *
 * How to use:
 * * include this extension in LocalSettings.php:
 *	 require_once($IP.'/extensions/MagicNoNumberedHeadings.php');
 * * Add "__NUMBEREDHEADINGS__" to any article of your choice.
 *
 * @author Zoran Dori
 * @version 1.1
 */

use MediaWiki\MediaWikiServices;

class MagicNumberedHeadings {

	/**
	 * @param array &$magicWords
	 * @return bool
	 */
	public static function onMagicWordMagicWords( array &$magicWords ) {
		$magicWords[] = 'MAG_NUMBEREDHEADINGS';
		return true;
	}

	/**
	 * @param array &$wgVariableIDs
	 * @return bool
	 */
	public static function onMagicWordwgVariableIDs( array &$wgVariableIDs ) {
		// phpcs:ignore MediaWiki.VariableAnalysis.MisleadingGlobalNames.Misleading$wgVariableIDs
		$wgVariableIDs[] = 'MAG_NUMBEREDHEADINGS';
		return true;
	}

	/**
	 * @param OutputPage &$out
	 * @param Parser $parser
	 * @param string $text
	 * @return bool
	 */
	public static function onOutputPageParserOutput( OutputPage &$out, Parser $parser, string $text
) {
		$mwf = MediaWikiServices::getInstance()->getMagicWordFactory();
		$out = RequestContext::getMain()->getOutput();
		if ( $mwf->get( 'MAG_NUMBEREDHEADINGS' )->matchAndRemove( $text ) ) {
			$out->addModules[ 'ext.NumberedHeadings' ];
		}
		return true;
	}
}
