<?php


/**
 * Base class that represents a query for the 'music' table.
 *
 * 
 *
 * @method     MusicQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     MusicQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     MusicQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     MusicQuery orderByAlbumId($order = Criteria::ASC) Order by the album_id column
 * @method     MusicQuery orderByGenre($order = Criteria::ASC) Order by the genre column
 * @method     MusicQuery orderByDateRelease($order = Criteria::ASC) Order by the date_release column
 * @method     MusicQuery orderByLabel($order = Criteria::ASC) Order by the label column
 * @method     MusicQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     MusicQuery orderByTrack($order = Criteria::ASC) Order by the track column
 * @method     MusicQuery orderByTrackPreview($order = Criteria::ASC) Order by the track_preview column
 * @method     MusicQuery orderByTrackLength($order = Criteria::ASC) Order by the track_length column
 * @method     MusicQuery orderByTrackPreviewLength($order = Criteria::ASC) Order by the track_preview_length column
 * @method     MusicQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 * @method     MusicQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     MusicQuery orderByDeleted($order = Criteria::ASC) Order by the deleted column
 *
 * @method     MusicQuery groupById() Group by the id column
 * @method     MusicQuery groupByUserId() Group by the user_id column
 * @method     MusicQuery groupByTitle() Group by the title column
 * @method     MusicQuery groupByAlbumId() Group by the album_id column
 * @method     MusicQuery groupByGenre() Group by the genre column
 * @method     MusicQuery groupByDateRelease() Group by the date_release column
 * @method     MusicQuery groupByLabel() Group by the label column
 * @method     MusicQuery groupByPrice() Group by the price column
 * @method     MusicQuery groupByTrack() Group by the track column
 * @method     MusicQuery groupByTrackPreview() Group by the track_preview column
 * @method     MusicQuery groupByTrackLength() Group by the track_length column
 * @method     MusicQuery groupByTrackPreviewLength() Group by the track_preview_length column
 * @method     MusicQuery groupByPdate() Group by the pdate column
 * @method     MusicQuery groupByActive() Group by the active column
 * @method     MusicQuery groupByDeleted() Group by the deleted column
 *
 * @method     MusicQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     MusicQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     MusicQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     MusicQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     MusicQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     MusicQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     MusicQuery leftJoinMusicAlbum($relationAlias = null) Adds a LEFT JOIN clause to the query using the MusicAlbum relation
 * @method     MusicQuery rightJoinMusicAlbum($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MusicAlbum relation
 * @method     MusicQuery innerJoinMusicAlbum($relationAlias = null) Adds a INNER JOIN clause to the query using the MusicAlbum relation
 *
 * @method     MusicQuery leftJoinMusicPurchase($relationAlias = null) Adds a LEFT JOIN clause to the query using the MusicPurchase relation
 * @method     MusicQuery rightJoinMusicPurchase($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MusicPurchase relation
 * @method     MusicQuery innerJoinMusicPurchase($relationAlias = null) Adds a INNER JOIN clause to the query using the MusicPurchase relation
 *
 * @method     MusicQuery leftJoinMusicPurchaseRelatedByMusicId($relationAlias = null) Adds a LEFT JOIN clause to the query using the MusicPurchaseRelatedByMusicId relation
 * @method     MusicQuery rightJoinMusicPurchaseRelatedByMusicId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MusicPurchaseRelatedByMusicId relation
 * @method     MusicQuery innerJoinMusicPurchaseRelatedByMusicId($relationAlias = null) Adds a INNER JOIN clause to the query using the MusicPurchaseRelatedByMusicId relation
 *
 * @method     Music findOne(PropelPDO $con = null) Return the first Music matching the query
 * @method     Music findOneOrCreate(PropelPDO $con = null) Return the first Music matching the query, or a new Music object populated from the query conditions when no match is found
 *
 * @method     Music findOneById(int $id) Return the first Music filtered by the id column
 * @method     Music findOneByUserId(int $user_id) Return the first Music filtered by the user_id column
 * @method     Music findOneByTitle(string $title) Return the first Music filtered by the title column
 * @method     Music findOneByAlbumId(int $album_id) Return the first Music filtered by the album_id column
 * @method     Music findOneByGenre(string $genre) Return the first Music filtered by the genre column
 * @method     Music findOneByDateRelease(string $date_release) Return the first Music filtered by the date_release column
 * @method     Music findOneByLabel(string $label) Return the first Music filtered by the label column
 * @method     Music findOneByPrice(double $price) Return the first Music filtered by the price column
 * @method     Music findOneByTrack(string $track) Return the first Music filtered by the track column
 * @method     Music findOneByTrackPreview(string $track_preview) Return the first Music filtered by the track_preview column
 * @method     Music findOneByTrackLength(string $track_length) Return the first Music filtered by the track_length column
 * @method     Music findOneByTrackPreviewLength(string $track_preview_length) Return the first Music filtered by the track_preview_length column
 * @method     Music findOneByPdate(int $pdate) Return the first Music filtered by the pdate column
 * @method     Music findOneByActive(int $active) Return the first Music filtered by the active column
 * @method     Music findOneByDeleted(int $deleted) Return the first Music filtered by the deleted column
 *
 * @method     array findById(int $id) Return Music objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return Music objects filtered by the user_id column
 * @method     array findByTitle(string $title) Return Music objects filtered by the title column
 * @method     array findByAlbumId(int $album_id) Return Music objects filtered by the album_id column
 * @method     array findByGenre(string $genre) Return Music objects filtered by the genre column
 * @method     array findByDateRelease(string $date_release) Return Music objects filtered by the date_release column
 * @method     array findByLabel(string $label) Return Music objects filtered by the label column
 * @method     array findByPrice(double $price) Return Music objects filtered by the price column
 * @method     array findByTrack(string $track) Return Music objects filtered by the track column
 * @method     array findByTrackPreview(string $track_preview) Return Music objects filtered by the track_preview column
 * @method     array findByTrackLength(string $track_length) Return Music objects filtered by the track_length column
 * @method     array findByTrackPreviewLength(string $track_preview_length) Return Music objects filtered by the track_preview_length column
 * @method     array findByPdate(int $pdate) Return Music objects filtered by the pdate column
 * @method     array findByActive(int $active) Return Music objects filtered by the active column
 * @method     array findByDeleted(int $deleted) Return Music objects filtered by the deleted column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseMusicQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseMusicQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Music', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new MusicQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    MusicQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof MusicQuery) {
			return $criteria;
		}
		$query = new MusicQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Music|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = MusicPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Music A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USER_ID`, `TITLE`, `ALBUM_ID`, `GENRE`, `DATE_RELEASE`, `LABEL`, `PRICE`, `TRACK`, `TRACK_PREVIEW`, `TRACK_LENGTH`, `TRACK_PREVIEW_LENGTH`, `PDATE`, `ACTIVE`, `DELETED`, `STATUS`, `UPC_CODE` FROM `music` WHERE `ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new Music();
			$obj->hydrate($row);
			MusicPeer::addInstanceToPool($obj, (string) $key);
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Music|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(MusicPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(MusicPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterById(1234); // WHERE id = 1234
	 * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterById(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @see       filterByMusicPurchase()
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(MusicPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUserId(1234); // WHERE user_id = 1234
	 * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
	 * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
	 * </code>
	 *
	 * @see       filterByUser()
	 *
	 * @param     mixed $userId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(MusicPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(MusicPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the title column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
	 * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $title The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByTitle($title = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($title)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $title)) {
				$title = str_replace('*', '%', $title);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MusicPeer::TITLE, $title, $comparison);
	}

	/**
	 * Filter the query on the album_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAlbumId(1234); // WHERE album_id = 1234
	 * $query->filterByAlbumId(array(12, 34)); // WHERE album_id IN (12, 34)
	 * $query->filterByAlbumId(array('min' => 12)); // WHERE album_id > 12
	 * </code>
	 *
	 * @see       filterByMusicAlbum()
	 *
	 * @param     mixed $albumId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByAlbumId($albumId = null, $comparison = null)
	{
		if (is_array($albumId)) {
			$useMinMax = false;
			if (isset($albumId['min'])) {
				$this->addUsingAlias(MusicPeer::ALBUM_ID, $albumId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($albumId['max'])) {
				$this->addUsingAlias(MusicPeer::ALBUM_ID, $albumId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicPeer::ALBUM_ID, $albumId, $comparison);
	}

	/**
	 * Filter the query on the genre column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByGenre('fooValue');   // WHERE genre = 'fooValue'
	 * $query->filterByGenre('%fooValue%'); // WHERE genre LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $genre The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByGenre($genre = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($genre)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $genre)) {
				$genre = str_replace('*', '%', $genre);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MusicPeer::GENRE, $genre, $comparison);
	}

	/**
	 * Filter the query on the date_release column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDateRelease('2011-03-14'); // WHERE date_release = '2011-03-14'
	 * $query->filterByDateRelease('now'); // WHERE date_release = '2011-03-14'
	 * $query->filterByDateRelease(array('max' => 'yesterday')); // WHERE date_release > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $dateRelease The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByDateRelease($dateRelease = null, $comparison = null)
	{
		if (is_array($dateRelease)) {
			$useMinMax = false;
			if (isset($dateRelease['min'])) {
				$this->addUsingAlias(MusicPeer::DATE_RELEASE, $dateRelease['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($dateRelease['max'])) {
				$this->addUsingAlias(MusicPeer::DATE_RELEASE, $dateRelease['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicPeer::DATE_RELEASE, $dateRelease, $comparison);
	}

	/**
	 * Filter the query on the label column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLabel('fooValue');   // WHERE label = 'fooValue'
	 * $query->filterByLabel('%fooValue%'); // WHERE label LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $label The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByLabel($label = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($label)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $label)) {
				$label = str_replace('*', '%', $label);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MusicPeer::LABEL, $label, $comparison);
	}

	/**
	 * Filter the query on the price column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPrice(1234); // WHERE price = 1234
	 * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
	 * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
	 * </code>
	 *
	 * @param     mixed $price The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByPrice($price = null, $comparison = null)
	{
		if (is_array($price)) {
			$useMinMax = false;
			if (isset($price['min'])) {
				$this->addUsingAlias(MusicPeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($price['max'])) {
				$this->addUsingAlias(MusicPeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicPeer::PRICE, $price, $comparison);
	}

	/**
	 * Filter the query on the track column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTrack('fooValue');   // WHERE track = 'fooValue'
	 * $query->filterByTrack('%fooValue%'); // WHERE track LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $track The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByTrack($track = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($track)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $track)) {
				$track = str_replace('*', '%', $track);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MusicPeer::TRACK, $track, $comparison);
	}

	/**
	 * Filter the query on the track_preview column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTrackPreview('fooValue');   // WHERE track_preview = 'fooValue'
	 * $query->filterByTrackPreview('%fooValue%'); // WHERE track_preview LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $trackPreview The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByTrackPreview($trackPreview = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($trackPreview)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $trackPreview)) {
				$trackPreview = str_replace('*', '%', $trackPreview);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MusicPeer::TRACK_PREVIEW, $trackPreview, $comparison);
	}

	/**
	 * Filter the query on the track_length column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTrackLength('fooValue');   // WHERE track_length = 'fooValue'
	 * $query->filterByTrackLength('%fooValue%'); // WHERE track_length LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $trackLength The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByTrackLength($trackLength = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($trackLength)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $trackLength)) {
				$trackLength = str_replace('*', '%', $trackLength);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MusicPeer::TRACK_LENGTH, $trackLength, $comparison);
	}

	/**
	 * Filter the query on the track_preview_length column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTrackPreviewLength('fooValue');   // WHERE track_preview_length = 'fooValue'
	 * $query->filterByTrackPreviewLength('%fooValue%'); // WHERE track_preview_length LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $trackPreviewLength The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByTrackPreviewLength($trackPreviewLength = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($trackPreviewLength)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $trackPreviewLength)) {
				$trackPreviewLength = str_replace('*', '%', $trackPreviewLength);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MusicPeer::TRACK_PREVIEW_LENGTH, $trackPreviewLength, $comparison);
	}

	/**
	 * Filter the query on the pdate column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPdate(1234); // WHERE pdate = 1234
	 * $query->filterByPdate(array(12, 34)); // WHERE pdate IN (12, 34)
	 * $query->filterByPdate(array('min' => 12)); // WHERE pdate > 12
	 * </code>
	 *
	 * @param     mixed $pdate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(MusicPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(MusicPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicPeer::PDATE, $pdate, $comparison);
	}

	/**
	 * Filter the query on the active column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByActive(1234); // WHERE active = 1234
	 * $query->filterByActive(array(12, 34)); // WHERE active IN (12, 34)
	 * $query->filterByActive(array('min' => 12)); // WHERE active > 12
	 * </code>
	 *
	 * @param     mixed $active The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByActive($active = null, $comparison = null)
	{
		if (is_array($active)) {
			$useMinMax = false;
			if (isset($active['min'])) {
				$this->addUsingAlias(MusicPeer::ACTIVE, $active['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($active['max'])) {
				$this->addUsingAlias(MusicPeer::ACTIVE, $active['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicPeer::ACTIVE, $active, $comparison);
	}

	/**
	 * Filter the query on the deleted column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDeleted(1234); // WHERE deleted = 1234
	 * $query->filterByDeleted(array(12, 34)); // WHERE deleted IN (12, 34)
	 * $query->filterByDeleted(array('min' => 12)); // WHERE deleted > 12
	 * </code>
	 *
	 * @param     mixed $deleted The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByDeleted($deleted = null, $comparison = null)
	{
		if (is_array($deleted)) {
			$useMinMax = false;
			if (isset($deleted['min'])) {
				$this->addUsingAlias(MusicPeer::DELETED, $deleted['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($deleted['max'])) {
				$this->addUsingAlias(MusicPeer::DELETED, $deleted['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicPeer::DELETED, $deleted, $comparison);
	}
	
	/**
	 * Filter the query on the status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByStatus(1234); // WHERE status = 1234
	 * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
	 * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
	 * </code>
	 *
	 * @param     mixed $stats The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByStatus($status = null, $comparison = null)
	{
		if (is_array($status)) {
			$useMinMax = false;
			if (isset($deleted['min'])) {
				$this->addUsingAlias(MusicPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($deleted['max'])) {
				$this->addUsingAlias(MusicPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicPeer::STATUS, $status, $comparison);
	}
	
	/**
	 * Filter the query on the upc_code column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUpcCode('fooValue');   // WHERE upc_code = 'fooValue'
	 * $query->filterByUpcCode('%fooValue%'); // WHERE upc_code LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $upcCode The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByUpcCode($upcCode = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($upcCode)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $upcCode)) {
				$upcCode = str_replace('*', '%', $upcCode);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MusicPeer::UPC_CODE, $upcCode, $comparison);
	}
	
	/**
	 * Filter the query on the pay_more column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPayMore(1234); // WHERE pay_more = 1234
	 * $query->filterByPayMore(array(12, 34)); // WHERE pay_more IN (12, 34)
	 * $query->filterByPayMore(array('min' => 12)); // WHERE pay_more > 12
	 * </code>
	 *
	 * @param     mixed $payMore The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByPayMore($payMore = null, $comparison = null)
	{
		if (is_array($payMore)) {
			$useMinMax = false;
			if (isset($payMore['min'])) {
				$this->addUsingAlias(MusicPeer::PAY_MORE, $payMore['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($payMore['max'])) {
				$this->addUsingAlias(MusicPeer::PAY_MORE, $payMore['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicPeer::PAY_MORE, $payMore, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(MusicPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(MusicPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByUser() only accepts arguments of type User or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the User relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function joinUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('User');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'User');
		}

		return $this;
	}

	/**
	 * Use the User relation User object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'User', 'UserQuery');
	}

	/**
	 * Filter the query by a related MusicAlbum object
	 *
	 * @param     MusicAlbum|PropelCollection $musicAlbum The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByMusicAlbum($musicAlbum, $comparison = null)
	{
		if ($musicAlbum instanceof MusicAlbum) {
			return $this
				->addUsingAlias(MusicPeer::ALBUM_ID, $musicAlbum->getId(), $comparison);
		} elseif ($musicAlbum instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(MusicPeer::ALBUM_ID, $musicAlbum->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByMusicAlbum() only accepts arguments of type MusicAlbum or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the MusicAlbum relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function joinMusicAlbum($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MusicAlbum');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'MusicAlbum');
		}

		return $this;
	}

	/**
	 * Use the MusicAlbum relation MusicAlbum object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MusicAlbumQuery A secondary query class using the current class as primary query
	 */
	public function useMusicAlbumQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinMusicAlbum($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MusicAlbum', 'MusicAlbumQuery');
	}

	/**
	 * Filter the query by a related MusicPurchase object
	 *
	 * @param     MusicPurchase|PropelCollection $musicPurchase The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByMusicPurchase($musicPurchase, $comparison = null)
	{
		if ($musicPurchase instanceof MusicPurchase) {
			return $this
				->addUsingAlias(MusicPeer::ID, $musicPurchase->getMusicId(), $comparison);
		} elseif ($musicPurchase instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(MusicPeer::ID, $musicPurchase->toKeyValue('PrimaryKey', 'MusicId'), $comparison);
		} else {
			throw new PropelException('filterByMusicPurchase() only accepts arguments of type MusicPurchase or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the MusicPurchase relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function joinMusicPurchase($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MusicPurchase');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'MusicPurchase');
		}

		return $this;
	}

	/**
	 * Use the MusicPurchase relation MusicPurchase object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MusicPurchaseQuery A secondary query class using the current class as primary query
	 */
	public function useMusicPurchaseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinMusicPurchase($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MusicPurchase', 'MusicPurchaseQuery');
	}

	/**
	 * Filter the query by a related MusicPurchase object
	 *
	 * @param     MusicPurchase $musicPurchase  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function filterByMusicPurchaseRelatedByMusicId($musicPurchase, $comparison = null)
	{
		if ($musicPurchase instanceof MusicPurchase) {
			return $this
				->addUsingAlias(MusicPeer::ID, $musicPurchase->getMusicId(), $comparison);
		} elseif ($musicPurchase instanceof PropelCollection) {
			return $this
				->useMusicPurchaseRelatedByMusicIdQuery()
				->filterByPrimaryKeys($musicPurchase->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByMusicPurchaseRelatedByMusicId() only accepts arguments of type MusicPurchase or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the MusicPurchaseRelatedByMusicId relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function joinMusicPurchaseRelatedByMusicId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MusicPurchaseRelatedByMusicId');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'MusicPurchaseRelatedByMusicId');
		}

		return $this;
	}

	/**
	 * Use the MusicPurchaseRelatedByMusicId relation MusicPurchase object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MusicPurchaseQuery A secondary query class using the current class as primary query
	 */
	public function useMusicPurchaseRelatedByMusicIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinMusicPurchaseRelatedByMusicId($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MusicPurchaseRelatedByMusicId', 'MusicPurchaseQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Music $music Object to remove from the list of results
	 *
	 * @return    MusicQuery The current query, for fluid interface
	 */
	public function prune($music = null)
	{
		if ($music) {
			$this->addUsingAlias(MusicPeer::ID, $music->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseMusicQuery