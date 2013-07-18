<?php


/**
 * Base class that represents a query for the 'music_album' table.
 *
 * 
 *
 * @method     MusicAlbumQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     MusicAlbumQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     MusicAlbumQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     MusicAlbumQuery orderByDescr($order = Criteria::ASC) Order by the descr column
 * @method     MusicAlbumQuery orderByDateRelease($order = Criteria::ASC) Order by the date_release column
 * @method     MusicAlbumQuery orderByImage($order = Criteria::ASC) Order by the image column
 * @method     MusicAlbumQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     MusicAlbumQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 * @method     MusicAlbumQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     MusicAlbumQuery orderByDeleted($order = Criteria::ASC) Order by the deleted column
 * @method     MusicAlbumQuery orderByFeatured($order = Criteria::ASC) Order by the featured column
 * @method     MusicAlbumQuery orderByAlbumPayMore($order = Criteria::ASC) Order by the album_pay_more column
 * @method     MusicAlbumQuery orderByGenre($order = Criteria::ASC) Order by the genre column
 * @method     MusicAlbumQuery orderByLabel($order = Criteria::ASC) Order by the label column
 * @method     MusicAlbumQuery orderByIsSingle($order = Criteria::ASC) Order by the is_single column
 *
 * @method     MusicAlbumQuery groupById() Group by the id column
 * @method     MusicAlbumQuery groupByUserId() Group by the user_id column
 * @method     MusicAlbumQuery groupByTitle() Group by the title column
 * @method     MusicAlbumQuery groupByDescr() Group by the descr column
 * @method     MusicAlbumQuery groupByDateRelease() Group by the date_release column
 * @method     MusicAlbumQuery groupByImage() Group by the image column
 * @method     MusicAlbumQuery groupByPrice() Group by the price column
 * @method     MusicAlbumQuery groupByPdate() Group by the pdate column
 * @method     MusicAlbumQuery groupByActive() Group by the active column
 * @method     MusicAlbumQuery groupByDeleted() Group by the deleted column
 * @method     MusicAlbumQuery groupByFeatured() Group by the featured column
 * @method     MusicAlbumQuery groupByAlbumPayMore() Group by the album_pay_more column
 * @method     MusicAlbumQuery groupByGenre() Group by the genre column
 * @method     MusicAlbumQuery groupByLabel() Group by the label column
 * @method     MusicAlbumQuery groupByIsSingle() Group by the is_single column
 *
 * @method     MusicAlbumQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     MusicAlbumQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     MusicAlbumQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     MusicAlbumQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     MusicAlbumQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     MusicAlbumQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     MusicAlbumQuery leftJoinMusic($relationAlias = null) Adds a LEFT JOIN clause to the query using the Music relation
 * @method     MusicAlbumQuery rightJoinMusic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Music relation
 * @method     MusicAlbumQuery innerJoinMusic($relationAlias = null) Adds a INNER JOIN clause to the query using the Music relation
 *
 * @method     MusicAlbum findOne(PropelPDO $con = null) Return the first MusicAlbum matching the query
 * @method     MusicAlbum findOneOrCreate(PropelPDO $con = null) Return the first MusicAlbum matching the query, or a new MusicAlbum object populated from the query conditions when no match is found
 *
 * @method     MusicAlbum findOneById(int $id) Return the first MusicAlbum filtered by the id column
 * @method     MusicAlbum findOneByUserId(int $user_id) Return the first MusicAlbum filtered by the user_id column
 * @method     MusicAlbum findOneByTitle(string $title) Return the first MusicAlbum filtered by the title column
 * @method     MusicAlbum findOneByDescr(string $descr) Return the first MusicAlbum filtered by the descr column
 * @method     MusicAlbum findOneByDateRelease(string $date_release) Return the first MusicAlbum filtered by the date_release column
 * @method     MusicAlbum findOneByImage(string $image) Return the first MusicAlbum filtered by the image column
 * @method     MusicAlbum findOneByPrice(double $price) Return the first MusicAlbum filtered by the price column
 * @method     MusicAlbum findOneByPdate(int $pdate) Return the first MusicAlbum filtered by the pdate column
 * @method     MusicAlbum findOneByActive(int $active) Return the first MusicAlbum filtered by the active column
 * @method     MusicAlbum findOneByDeleted(int $deleted) Return the first MusicAlbum filtered by the deleted column
 * @method     MusicAlbum findOneByFeatured(int $featured) Return the first MusicAlbum filtered by the featured column
 * @method     MusicAlbum findOneByAlbumPayMore(int $album_pay_more) Return the first MusicAlbum filtered by the album_pay_more column
 * @method     MusicAlbum findOneByGenre(string $genre) Return the first MusicAlbum filtered by the genre column
 * @method     MusicAlbum findOneByLabel(string $label) Return the first MusicAlbum filtered by the label column
 * @method     MusicAlbum findOneByIsSingle(int $is_single) Return the first MusicAlbum filtered by the is_single column
 *
 * @method     array findById(int $id) Return MusicAlbum objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return MusicAlbum objects filtered by the user_id column
 * @method     array findByTitle(string $title) Return MusicAlbum objects filtered by the title column
 * @method     array findByDescr(string $descr) Return MusicAlbum objects filtered by the descr column
 * @method     array findByDateRelease(string $date_release) Return MusicAlbum objects filtered by the date_release column
 * @method     array findByImage(string $image) Return MusicAlbum objects filtered by the image column
 * @method     array findByPrice(double $price) Return MusicAlbum objects filtered by the price column
 * @method     array findByPdate(int $pdate) Return MusicAlbum objects filtered by the pdate column
 * @method     array findByActive(int $active) Return MusicAlbum objects filtered by the active column
 * @method     array findByDeleted(int $deleted) Return MusicAlbum objects filtered by the deleted column
 * @method     array findByFeatured(int $featured) Return MusicAlbum objects filtered by the featured column
 * @method     array findByAlbumPayMore(int $album_pay_more) Return MusicAlbum objects filtered by the album_pay_more column
 * @method     array findByGenre(string $genre) Return MusicAlbum objects filtered by the genre column
 * @method     array findByLabel(string $label) Return MusicAlbum objects filtered by the label column
 * @method     array findByIsSingle(int $is_single) Return MusicAlbum objects filtered by the is_single column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseMusicAlbumQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseMusicAlbumQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'MusicAlbum', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new MusicAlbumQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    MusicAlbumQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof MusicAlbumQuery) {
			return $criteria;
		}
		$query = new MusicAlbumQuery();
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
	 * @return    MusicAlbum|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = MusicAlbumPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(MusicAlbumPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    MusicAlbum A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USER_ID`, `TITLE`, `DESCR`, `DATE_RELEASE`, `IMAGE`, `PRICE`, `PDATE`, `ACTIVE`, `DELETED`, `FEATURED`, `ALBUM_PAY_MORE`, `GENRE`, `LABEL`, `IS_SINGLE` FROM `music_album` WHERE `ID` = :p0';
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
			$obj = new MusicAlbum();
			$obj->hydrate($row);
			MusicAlbumPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    MusicAlbum|array|mixed the result, formatted by the current formatter
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
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(MusicAlbumPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(MusicAlbumPeer::ID, $keys, Criteria::IN);
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
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(MusicAlbumPeer::ID, $id, $comparison);
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
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(MusicAlbumPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(MusicAlbumPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicAlbumPeer::USER_ID, $userId, $comparison);
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
	 * @return    MusicAlbumQuery The current query, for fluid interface
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
		return $this->addUsingAlias(MusicAlbumPeer::TITLE, $title, $comparison);
	}

	/**
	 * Filter the query on the descr column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDescr('fooValue');   // WHERE descr = 'fooValue'
	 * $query->filterByDescr('%fooValue%'); // WHERE descr LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $descr The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterByDescr($descr = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($descr)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $descr)) {
				$descr = str_replace('*', '%', $descr);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MusicAlbumPeer::DESCR, $descr, $comparison);
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
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterByDateRelease($dateRelease = null, $comparison = null)
	{
		if (is_array($dateRelease)) {
			$useMinMax = false;
			if (isset($dateRelease['min'])) {
				$this->addUsingAlias(MusicAlbumPeer::DATE_RELEASE, $dateRelease['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($dateRelease['max'])) {
				$this->addUsingAlias(MusicAlbumPeer::DATE_RELEASE, $dateRelease['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicAlbumPeer::DATE_RELEASE, $dateRelease, $comparison);
	}

	/**
	 * Filter the query on the image column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByImage('fooValue');   // WHERE image = 'fooValue'
	 * $query->filterByImage('%fooValue%'); // WHERE image LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $image The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterByImage($image = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($image)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $image)) {
				$image = str_replace('*', '%', $image);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MusicAlbumPeer::IMAGE, $image, $comparison);
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
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterByPrice($price = null, $comparison = null)
	{
		if (is_array($price)) {
			$useMinMax = false;
			if (isset($price['min'])) {
				$this->addUsingAlias(MusicAlbumPeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($price['max'])) {
				$this->addUsingAlias(MusicAlbumPeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicAlbumPeer::PRICE, $price, $comparison);
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
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(MusicAlbumPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(MusicAlbumPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicAlbumPeer::PDATE, $pdate, $comparison);
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
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterByActive($active = null, $comparison = null)
	{
		if (is_array($active)) {
			$useMinMax = false;
			if (isset($active['min'])) {
				$this->addUsingAlias(MusicAlbumPeer::ACTIVE, $active['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($active['max'])) {
				$this->addUsingAlias(MusicAlbumPeer::ACTIVE, $active['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicAlbumPeer::ACTIVE, $active, $comparison);
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
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterByDeleted($deleted = null, $comparison = null)
	{
		if (is_array($deleted)) {
			$useMinMax = false;
			if (isset($deleted['min'])) {
				$this->addUsingAlias(MusicAlbumPeer::DELETED, $deleted['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($deleted['max'])) {
				$this->addUsingAlias(MusicAlbumPeer::DELETED, $deleted['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicAlbumPeer::DELETED, $deleted, $comparison);
	}

	/**
	 * Filter the query on the featured column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFeatured(1234); // WHERE featured = 1234
	 * $query->filterByFeatured(array(12, 34)); // WHERE featured IN (12, 34)
	 * $query->filterByFeatured(array('min' => 12)); // WHERE featured > 12
	 * </code>
	 *
	 * @param     mixed $featured The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterByFeatured($featured = null, $comparison = null)
	{
		if (is_array($featured)) {
			$useMinMax = false;
			if (isset($featured['min'])) {
				$this->addUsingAlias(MusicAlbumPeer::FEATURED, $featured['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($featured['max'])) {
				$this->addUsingAlias(MusicAlbumPeer::FEATURED, $featured['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicAlbumPeer::FEATURED, $featured, $comparison);
	}

	/**
	 * Filter the query on the album_pay_more column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAlbumPayMore(1234); // WHERE album_pay_more = 1234
	 * $query->filterByAlbumPayMore(array(12, 34)); // WHERE album_pay_more IN (12, 34)
	 * $query->filterByAlbumPayMore(array('min' => 12)); // WHERE album_pay_more > 12
	 * </code>
	 *
	 * @param     mixed $albumPayMore The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterByAlbumPayMore($albumPayMore = null, $comparison = null)
	{
		if (is_array($albumPayMore)) {
			$useMinMax = false;
			if (isset($albumPayMore['min'])) {
				$this->addUsingAlias(MusicAlbumPeer::ALBUM_PAY_MORE, $albumPayMore['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($albumPayMore['max'])) {
				$this->addUsingAlias(MusicAlbumPeer::ALBUM_PAY_MORE, $albumPayMore['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicAlbumPeer::ALBUM_PAY_MORE, $albumPayMore, $comparison);
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
	 * @return    MusicAlbumQuery The current query, for fluid interface
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
		return $this->addUsingAlias(MusicAlbumPeer::GENRE, $genre, $comparison);
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
	 * @return    MusicAlbumQuery The current query, for fluid interface
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
		return $this->addUsingAlias(MusicAlbumPeer::LABEL, $label, $comparison);
	}

	/**
	 * Filter the query on the is_single column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIsSingle(1234); // WHERE is_single = 1234
	 * $query->filterByIsSingle(array(12, 34)); // WHERE is_single IN (12, 34)
	 * $query->filterByIsSingle(array('min' => 12)); // WHERE is_single > 12
	 * </code>
	 *
	 * @param     mixed $isSingle The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterByIsSingle($isSingle = null, $comparison = null)
	{
		if (is_array($isSingle)) {
			$useMinMax = false;
			if (isset($isSingle['min'])) {
				$this->addUsingAlias(MusicAlbumPeer::IS_SINGLE, $isSingle['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($isSingle['max'])) {
				$this->addUsingAlias(MusicAlbumPeer::IS_SINGLE, $isSingle['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(MusicAlbumPeer::IS_SINGLE, $isSingle, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(MusicAlbumPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(MusicAlbumPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    MusicAlbumQuery The current query, for fluid interface
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
	 * Filter the query by a related Music object
	 *
	 * @param     Music $music  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function filterByMusic($music, $comparison = null)
	{
		if ($music instanceof Music) {
			return $this
				->addUsingAlias(MusicAlbumPeer::ID, $music->getAlbumId(), $comparison);
		} elseif ($music instanceof PropelCollection) {
			return $this
				->useMusicQuery()
				->filterByPrimaryKeys($music->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByMusic() only accepts arguments of type Music or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Music relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function joinMusic($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Music');

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
			$this->addJoinObject($join, 'Music');
		}

		return $this;
	}

	/**
	 * Use the Music relation Music object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MusicQuery A secondary query class using the current class as primary query
	 */
	public function useMusicQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinMusic($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Music', 'MusicQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     MusicAlbum $musicAlbum Object to remove from the list of results
	 *
	 * @return    MusicAlbumQuery The current query, for fluid interface
	 */
	public function prune($musicAlbum = null)
	{
		if ($musicAlbum) {
			$this->addUsingAlias(MusicAlbumPeer::ID, $musicAlbum->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseMusicAlbumQuery