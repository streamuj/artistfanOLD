<?php


/**
 * Base class that represents a query for the 'purchase' table.
 *
 * 
 *
 * @method     PurchaseQuery orderByPcId($order = Criteria::ASC) Order by the pc_id column
 * @method     PurchaseQuery orderByPcTypeName($order = Criteria::ASC) Order by the pc_type_name column
 * @method     PurchaseQuery orderByPcTypeId($order = Criteria::ASC) Order by the pc_type_id column
 * @method     PurchaseQuery orderByPcPrice($order = Criteria::ASC) Order by the pc_price column
 * @method     PurchaseQuery orderByPcDescription($order = Criteria::ASC) Order by the pc_description column
 * @method     PurchaseQuery orderByPcDate($order = Criteria::ASC) Order by the pc_date column
 * @method     PurchaseQuery orderByPcUserId($order = Criteria::ASC) Order by the pc_user_id column
 * @method     PurchaseQuery orderByPcArtistId($order = Criteria::ASC) Order by the pc_artist_id column
 *
 * @method     PurchaseQuery groupByPcId() Group by the pc_id column
 * @method     PurchaseQuery groupByPcTypeName() Group by the pc_type_name column
 * @method     PurchaseQuery groupByPcTypeId() Group by the pc_type_id column
 * @method     PurchaseQuery groupByPcPrice() Group by the pc_price column
 * @method     PurchaseQuery groupByPcDescription() Group by the pc_description column
 * @method     PurchaseQuery groupByPcDate() Group by the pc_date column
 * @method     PurchaseQuery groupByPcUserId() Group by the pc_user_id column
 * @method     PurchaseQuery groupByPcArtistId() Group by the pc_artist_id column
 *
 * @method     PurchaseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PurchaseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PurchaseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Purchase findOne(PropelPDO $con = null) Return the first Purchase matching the query
 * @method     Purchase findOneOrCreate(PropelPDO $con = null) Return the first Purchase matching the query, or a new Purchase object populated from the query conditions when no match is found
 *
 * @method     Purchase findOneByPcId(int $pc_id) Return the first Purchase filtered by the pc_id column
 * @method     Purchase findOneByPcTypeName(string $pc_type_name) Return the first Purchase filtered by the pc_type_name column
 * @method     Purchase findOneByPcTypeId(int $pc_type_id) Return the first Purchase filtered by the pc_type_id column
 * @method     Purchase findOneByPcPrice(double $pc_price) Return the first Purchase filtered by the pc_price column
 * @method     Purchase findOneByPcDescription(string $pc_description) Return the first Purchase filtered by the pc_description column
 * @method     Purchase findOneByPcDate(int $pc_date) Return the first Purchase filtered by the pc_date column
 * @method     Purchase findOneByPcUserId(int $pc_user_id) Return the first Purchase filtered by the pc_user_id column
 * @method     Purchase findOneByPcArtistId(int $pc_artist_id) Return the first Purchase filtered by the pc_artist_id column
 *
 * @method     array findByPcId(int $pc_id) Return Purchase objects filtered by the pc_id column
 * @method     array findByPcTypeName(string $pc_type_name) Return Purchase objects filtered by the pc_type_name column
 * @method     array findByPcTypeId(int $pc_type_id) Return Purchase objects filtered by the pc_type_id column
 * @method     array findByPcPrice(double $pc_price) Return Purchase objects filtered by the pc_price column
 * @method     array findByPcDescription(string $pc_description) Return Purchase objects filtered by the pc_description column
 * @method     array findByPcDate(int $pc_date) Return Purchase objects filtered by the pc_date column
 * @method     array findByPcUserId(int $pc_user_id) Return Purchase objects filtered by the pc_user_id column
 * @method     array findByPcArtistId(int $pc_artist_id) Return Purchase objects filtered by the pc_artist_id column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BasePurchaseQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BasePurchaseQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Purchase', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new PurchaseQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    PurchaseQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof PurchaseQuery) {
			return $criteria;
		}
		$query = new PurchaseQuery();
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
	 * @return    Purchase|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = PurchasePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Purchase A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `PC_ID`, `PC_TYPE_NAME`, `PC_TYPE_ID`, `PC_PRICE`, `PC_DESCRIPTION`, `PC_DATE`, `PC_USER_ID`, `PC_ARTIST_ID` FROM `purchase` WHERE `PC_ID` = :p0';
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
			$obj = new Purchase();
			$obj->hydrate($row);
			PurchasePeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Purchase|array|mixed the result, formatted by the current formatter
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
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(PurchasePeer::PC_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(PurchasePeer::PC_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the pc_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPcId(1234); // WHERE pc_id = 1234
	 * $query->filterByPcId(array(12, 34)); // WHERE pc_id IN (12, 34)
	 * $query->filterByPcId(array('min' => 12)); // WHERE pc_id > 12
	 * </code>
	 *
	 * @param     mixed $pcId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByPcId($pcId = null, $comparison = null)
	{
		if (is_array($pcId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(PurchasePeer::PC_ID, $pcId, $comparison);
	}

	/**
	 * Filter the query on the pc_type_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPcTypeName('fooValue');   // WHERE pc_type_name = 'fooValue'
	 * $query->filterByPcTypeName('%fooValue%'); // WHERE pc_type_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $pcTypeName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByPcTypeName($pcTypeName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($pcTypeName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $pcTypeName)) {
				$pcTypeName = str_replace('*', '%', $pcTypeName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PurchasePeer::PC_TYPE_NAME, $pcTypeName, $comparison);
	}

	/**
	 * Filter the query on the pc_type_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPcTypeId(1234); // WHERE pc_type_id = 1234
	 * $query->filterByPcTypeId(array(12, 34)); // WHERE pc_type_id IN (12, 34)
	 * $query->filterByPcTypeId(array('min' => 12)); // WHERE pc_type_id > 12
	 * </code>
	 *
	 * @param     mixed $pcTypeId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByPcTypeId($pcTypeId = null, $comparison = null)
	{
		if (is_array($pcTypeId)) {
			$useMinMax = false;
			if (isset($pcTypeId['min'])) {
				$this->addUsingAlias(PurchasePeer::PC_TYPE_ID, $pcTypeId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pcTypeId['max'])) {
				$this->addUsingAlias(PurchasePeer::PC_TYPE_ID, $pcTypeId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PurchasePeer::PC_TYPE_ID, $pcTypeId, $comparison);
	}

	/**
	 * Filter the query on the pc_price column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPcPrice(1234); // WHERE pc_price = 1234
	 * $query->filterByPcPrice(array(12, 34)); // WHERE pc_price IN (12, 34)
	 * $query->filterByPcPrice(array('min' => 12)); // WHERE pc_price > 12
	 * </code>
	 *
	 * @param     mixed $pcPrice The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByPcPrice($pcPrice = null, $comparison = null)
	{
		if (is_array($pcPrice)) {
			$useMinMax = false;
			if (isset($pcPrice['min'])) {
				$this->addUsingAlias(PurchasePeer::PC_PRICE, $pcPrice['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pcPrice['max'])) {
				$this->addUsingAlias(PurchasePeer::PC_PRICE, $pcPrice['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PurchasePeer::PC_PRICE, $pcPrice, $comparison);
	}

	/**
	 * Filter the query on the pc_description column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPcDescription('fooValue');   // WHERE pc_description = 'fooValue'
	 * $query->filterByPcDescription('%fooValue%'); // WHERE pc_description LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $pcDescription The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByPcDescription($pcDescription = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($pcDescription)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $pcDescription)) {
				$pcDescription = str_replace('*', '%', $pcDescription);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PurchasePeer::PC_DESCRIPTION, $pcDescription, $comparison);
	}

	/**
	 * Filter the query on the pc_date column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPcDate(1234); // WHERE pc_date = 1234
	 * $query->filterByPcDate(array(12, 34)); // WHERE pc_date IN (12, 34)
	 * $query->filterByPcDate(array('min' => 12)); // WHERE pc_date > 12
	 * </code>
	 *
	 * @param     mixed $pcDate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByPcDate($pcDate = null, $comparison = null)
	{
		if (is_array($pcDate)) {
			$useMinMax = false;
			if (isset($pcDate['min'])) {
				$this->addUsingAlias(PurchasePeer::PC_DATE, $pcDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pcDate['max'])) {
				$this->addUsingAlias(PurchasePeer::PC_DATE, $pcDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PurchasePeer::PC_DATE, $pcDate, $comparison);
	}

	/**
	 * Filter the query on the pc_user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPcUserId(1234); // WHERE pc_user_id = 1234
	 * $query->filterByPcUserId(array(12, 34)); // WHERE pc_user_id IN (12, 34)
	 * $query->filterByPcUserId(array('min' => 12)); // WHERE pc_user_id > 12
	 * </code>
	 *
	 * @param     mixed $pcUserId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByPcUserId($pcUserId = null, $comparison = null)
	{
		if (is_array($pcUserId)) {
			$useMinMax = false;
			if (isset($pcUserId['min'])) {
				$this->addUsingAlias(PurchasePeer::PC_USER_ID, $pcUserId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pcUserId['max'])) {
				$this->addUsingAlias(PurchasePeer::PC_USER_ID, $pcUserId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PurchasePeer::PC_USER_ID, $pcUserId, $comparison);
	}

	/**
	 * Filter the query on the pc_artist_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPcArtistId(1234); // WHERE pc_artist_id = 1234
	 * $query->filterByPcArtistId(array(12, 34)); // WHERE pc_artist_id IN (12, 34)
	 * $query->filterByPcArtistId(array('min' => 12)); // WHERE pc_artist_id > 12
	 * </code>
	 *
	 * @param     mixed $pcArtistId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByPcArtistId($pcArtistId = null, $comparison = null)
	{
		if (is_array($pcArtistId)) {
			$useMinMax = false;
			if (isset($pcArtistId['min'])) {
				$this->addUsingAlias(PurchasePeer::PC_ARTIST_ID, $pcArtistId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pcArtistId['max'])) {
				$this->addUsingAlias(PurchasePeer::PC_ARTIST_ID, $pcArtistId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PurchasePeer::PC_ARTIST_ID, $pcArtistId, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Purchase $purchase Object to remove from the list of results
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function prune($purchase = null)
	{
		if ($purchase) {
			$this->addUsingAlias(PurchasePeer::PC_ID, $purchase->getPcId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BasePurchaseQuery