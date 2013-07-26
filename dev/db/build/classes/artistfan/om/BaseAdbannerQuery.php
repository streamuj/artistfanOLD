<?php


/**
 * Base class that represents a query for the 'adbanner' table.
 *
 * 
 *
 * @method     AdbannerQuery orderByAdbId($order = Criteria::ASC) Order by the adb_id column
 * @method     AdbannerQuery orderByAdbCatId($order = Criteria::ASC) Order by the adb_cat_id column
 * @method     AdbannerQuery orderByAdbImage($order = Criteria::ASC) Order by the adb_image column
 * @method     AdbannerQuery orderByAdbType($order = Criteria::ASC) Order by the adb_type column
 * @method     AdbannerQuery orderByAdbNew($order = Criteria::ASC) Order by the adb_new column
 * @method     AdbannerQuery orderByAdbLink($order = Criteria::ASC) Order by the adb_link column
 * @method     AdbannerQuery orderByAdbStatus($order = Criteria::ASC) Order by the adb_status column
 * @method     AdbannerQuery orderByCreatedOn($order = Criteria::ASC) Order by the created_on column
 * @method     AdbannerQuery orderByCreatedBy($order = Criteria::ASC) Order by the created_by column
 * @method     AdbannerQuery orderByModifiedOn($order = Criteria::ASC) Order by the modified_on column
 * @method     AdbannerQuery orderByModifiedBy($order = Criteria::ASC) Order by the modified_by column
 * @method     AdbannerQuery orderByAdbOrder($order = Criteria::ASC) Order by the adb_order column
 * @method     AdbannerQuery orderByAdbPage($order = Criteria::ASC) Order by the adb_page column
 *
 * @method     AdbannerQuery groupByAdbId() Group by the adb_id column
 * @method     AdbannerQuery groupByAdbCatId() Group by the adb_cat_id column
 * @method     AdbannerQuery groupByAdbImage() Group by the adb_image column
 * @method     AdbannerQuery groupByAdbType() Group by the adb_type column
 * @method     AdbannerQuery groupByAdbNew() Group by the adb_new column
 * @method     AdbannerQuery groupByAdbLink() Group by the adb_link column
 * @method     AdbannerQuery groupByAdbStatus() Group by the adb_status column
 * @method     AdbannerQuery groupByCreatedOn() Group by the created_on column
 * @method     AdbannerQuery groupByCreatedBy() Group by the created_by column
 * @method     AdbannerQuery groupByModifiedOn() Group by the modified_on column
 * @method     AdbannerQuery groupByModifiedBy() Group by the modified_by column
 * @method     AdbannerQuery groupByAdbOrder() Group by the adb_order column
 * @method     AdbannerQuery groupByAdbPage() Group by the adb_page column
 *
 * @method     AdbannerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     AdbannerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     AdbannerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Adbanner findOne(PropelPDO $con = null) Return the first Adbanner matching the query
 * @method     Adbanner findOneOrCreate(PropelPDO $con = null) Return the first Adbanner matching the query, or a new Adbanner object populated from the query conditions when no match is found
 *
 * @method     Adbanner findOneByAdbId(int $adb_id) Return the first Adbanner filtered by the adb_id column
 * @method     Adbanner findOneByAdbCatId(int $adb_cat_id) Return the first Adbanner filtered by the adb_cat_id column
 * @method     Adbanner findOneByAdbImage(string $adb_image) Return the first Adbanner filtered by the adb_image column
 * @method     Adbanner findOneByAdbType(int $adb_type) Return the first Adbanner filtered by the adb_type column
 * @method     Adbanner findOneByAdbNew(int $adb_new) Return the first Adbanner filtered by the adb_new column
 * @method     Adbanner findOneByAdbLink(string $adb_link) Return the first Adbanner filtered by the adb_link column
 * @method     Adbanner findOneByAdbStatus(int $adb_status) Return the first Adbanner filtered by the adb_status column
 * @method     Adbanner findOneByCreatedOn(int $created_on) Return the first Adbanner filtered by the created_on column
 * @method     Adbanner findOneByCreatedBy(int $created_by) Return the first Adbanner filtered by the created_by column
 * @method     Adbanner findOneByModifiedOn(int $modified_on) Return the first Adbanner filtered by the modified_on column
 * @method     Adbanner findOneByModifiedBy(int $modified_by) Return the first Adbanner filtered by the modified_by column
 * @method     Adbanner findOneByAdbOrder(int $adb_order) Return the first Adbanner filtered by the adb_order column
 * @method     Adbanner findOneByAdbPage(string $adb_page) Return the first Adbanner filtered by the adb_page column
 *
 * @method     array findByAdbId(int $adb_id) Return Adbanner objects filtered by the adb_id column
 * @method     array findByAdbCatId(int $adb_cat_id) Return Adbanner objects filtered by the adb_cat_id column
 * @method     array findByAdbImage(string $adb_image) Return Adbanner objects filtered by the adb_image column
 * @method     array findByAdbType(int $adb_type) Return Adbanner objects filtered by the adb_type column
 * @method     array findByAdbNew(int $adb_new) Return Adbanner objects filtered by the adb_new column
 * @method     array findByAdbLink(string $adb_link) Return Adbanner objects filtered by the adb_link column
 * @method     array findByAdbStatus(int $adb_status) Return Adbanner objects filtered by the adb_status column
 * @method     array findByCreatedOn(int $created_on) Return Adbanner objects filtered by the created_on column
 * @method     array findByCreatedBy(int $created_by) Return Adbanner objects filtered by the created_by column
 * @method     array findByModifiedOn(int $modified_on) Return Adbanner objects filtered by the modified_on column
 * @method     array findByModifiedBy(int $modified_by) Return Adbanner objects filtered by the modified_by column
 * @method     array findByAdbOrder(int $adb_order) Return Adbanner objects filtered by the adb_order column
 * @method     array findByAdbPage(string $adb_page) Return Adbanner objects filtered by the adb_page column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseAdbannerQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseAdbannerQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Adbanner', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new AdbannerQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AdbannerQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AdbannerQuery) {
			return $criteria;
		}
		$query = new AdbannerQuery();
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
	 * @return    Adbanner|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = AdbannerPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(AdbannerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Adbanner A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ADB_ID`, `ADB_CAT_ID`, `ADB_IMAGE`, `ADB_TYPE`, `ADB_NEW`, `ADB_LINK`, `ADB_STATUS`, `CREATED_ON`, `CREATED_BY`, `MODIFIED_ON`, `MODIFIED_BY`, `ADB_ORDER`, `ADB_PAGE` FROM `adbanner` WHERE `ADB_ID` = :p0';
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
			$obj = new Adbanner();
			$obj->hydrate($row);
			AdbannerPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Adbanner|array|mixed the result, formatted by the current formatter
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
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(AdbannerPeer::ADB_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(AdbannerPeer::ADB_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the adb_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAdbId(1234); // WHERE adb_id = 1234
	 * $query->filterByAdbId(array(12, 34)); // WHERE adb_id IN (12, 34)
	 * $query->filterByAdbId(array('min' => 12)); // WHERE adb_id > 12
	 * </code>
	 *
	 * @param     mixed $adbId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function filterByAdbId($adbId = null, $comparison = null)
	{
		if (is_array($adbId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AdbannerPeer::ADB_ID, $adbId, $comparison);
	}

	/**
	 * Filter the query on the adb_cat_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAdbCatId(1234); // WHERE adb_cat_id = 1234
	 * $query->filterByAdbCatId(array(12, 34)); // WHERE adb_cat_id IN (12, 34)
	 * $query->filterByAdbCatId(array('min' => 12)); // WHERE adb_cat_id > 12
	 * </code>
	 *
	 * @param     mixed $adbCatId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function filterByAdbCatId($adbCatId = null, $comparison = null)
	{
		if (is_array($adbCatId)) {
			$useMinMax = false;
			if (isset($adbCatId['min'])) {
				$this->addUsingAlias(AdbannerPeer::ADB_CAT_ID, $adbCatId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($adbCatId['max'])) {
				$this->addUsingAlias(AdbannerPeer::ADB_CAT_ID, $adbCatId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdbannerPeer::ADB_CAT_ID, $adbCatId, $comparison);
	}

	/**
	 * Filter the query on the adb_image column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAdbImage('fooValue');   // WHERE adb_image = 'fooValue'
	 * $query->filterByAdbImage('%fooValue%'); // WHERE adb_image LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $adbImage The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function filterByAdbImage($adbImage = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($adbImage)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $adbImage)) {
				$adbImage = str_replace('*', '%', $adbImage);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AdbannerPeer::ADB_IMAGE, $adbImage, $comparison);
	}

	/**
	 * Filter the query on the adb_type column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAdbType(1234); // WHERE adb_type = 1234
	 * $query->filterByAdbType(array(12, 34)); // WHERE adb_type IN (12, 34)
	 * $query->filterByAdbType(array('min' => 12)); // WHERE adb_type > 12
	 * </code>
	 *
	 * @param     mixed $adbType The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function filterByAdbType($adbType = null, $comparison = null)
	{
		if (is_array($adbType)) {
			$useMinMax = false;
			if (isset($adbType['min'])) {
				$this->addUsingAlias(AdbannerPeer::ADB_TYPE, $adbType['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($adbType['max'])) {
				$this->addUsingAlias(AdbannerPeer::ADB_TYPE, $adbType['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdbannerPeer::ADB_TYPE, $adbType, $comparison);
	}

	/**
	 * Filter the query on the adb_new column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAdbNew(1234); // WHERE adb_new = 1234
	 * $query->filterByAdbNew(array(12, 34)); // WHERE adb_new IN (12, 34)
	 * $query->filterByAdbNew(array('min' => 12)); // WHERE adb_new > 12
	 * </code>
	 *
	 * @param     mixed $adbNew The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function filterByAdbNew($adbNew = null, $comparison = null)
	{
		if (is_array($adbNew)) {
			$useMinMax = false;
			if (isset($adbNew['min'])) {
				$this->addUsingAlias(AdbannerPeer::ADB_NEW, $adbNew['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($adbNew['max'])) {
				$this->addUsingAlias(AdbannerPeer::ADB_NEW, $adbNew['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdbannerPeer::ADB_NEW, $adbNew, $comparison);
	}

	/**
	 * Filter the query on the adb_link column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAdbLink('fooValue');   // WHERE adb_link = 'fooValue'
	 * $query->filterByAdbLink('%fooValue%'); // WHERE adb_link LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $adbLink The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function filterByAdbLink($adbLink = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($adbLink)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $adbLink)) {
				$adbLink = str_replace('*', '%', $adbLink);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AdbannerPeer::ADB_LINK, $adbLink, $comparison);
	}

	/**
	 * Filter the query on the adb_status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAdbStatus(1234); // WHERE adb_status = 1234
	 * $query->filterByAdbStatus(array(12, 34)); // WHERE adb_status IN (12, 34)
	 * $query->filterByAdbStatus(array('min' => 12)); // WHERE adb_status > 12
	 * </code>
	 *
	 * @param     mixed $adbStatus The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function filterByAdbStatus($adbStatus = null, $comparison = null)
	{
		if (is_array($adbStatus)) {
			$useMinMax = false;
			if (isset($adbStatus['min'])) {
				$this->addUsingAlias(AdbannerPeer::ADB_STATUS, $adbStatus['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($adbStatus['max'])) {
				$this->addUsingAlias(AdbannerPeer::ADB_STATUS, $adbStatus['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdbannerPeer::ADB_STATUS, $adbStatus, $comparison);
	}

	/**
	 * Filter the query on the created_on column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCreatedOn(1234); // WHERE created_on = 1234
	 * $query->filterByCreatedOn(array(12, 34)); // WHERE created_on IN (12, 34)
	 * $query->filterByCreatedOn(array('min' => 12)); // WHERE created_on > 12
	 * </code>
	 *
	 * @param     mixed $createdOn The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function filterByCreatedOn($createdOn = null, $comparison = null)
	{
		if (is_array($createdOn)) {
			$useMinMax = false;
			if (isset($createdOn['min'])) {
				$this->addUsingAlias(AdbannerPeer::CREATED_ON, $createdOn['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdOn['max'])) {
				$this->addUsingAlias(AdbannerPeer::CREATED_ON, $createdOn['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdbannerPeer::CREATED_ON, $createdOn, $comparison);
	}

	/**
	 * Filter the query on the created_by column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCreatedBy(1234); // WHERE created_by = 1234
	 * $query->filterByCreatedBy(array(12, 34)); // WHERE created_by IN (12, 34)
	 * $query->filterByCreatedBy(array('min' => 12)); // WHERE created_by > 12
	 * </code>
	 *
	 * @param     mixed $createdBy The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function filterByCreatedBy($createdBy = null, $comparison = null)
	{
		if (is_array($createdBy)) {
			$useMinMax = false;
			if (isset($createdBy['min'])) {
				$this->addUsingAlias(AdbannerPeer::CREATED_BY, $createdBy['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdBy['max'])) {
				$this->addUsingAlias(AdbannerPeer::CREATED_BY, $createdBy['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdbannerPeer::CREATED_BY, $createdBy, $comparison);
	}

	/**
	 * Filter the query on the modified_on column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByModifiedOn(1234); // WHERE modified_on = 1234
	 * $query->filterByModifiedOn(array(12, 34)); // WHERE modified_on IN (12, 34)
	 * $query->filterByModifiedOn(array('min' => 12)); // WHERE modified_on > 12
	 * </code>
	 *
	 * @param     mixed $modifiedOn The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function filterByModifiedOn($modifiedOn = null, $comparison = null)
	{
		if (is_array($modifiedOn)) {
			$useMinMax = false;
			if (isset($modifiedOn['min'])) {
				$this->addUsingAlias(AdbannerPeer::MODIFIED_ON, $modifiedOn['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($modifiedOn['max'])) {
				$this->addUsingAlias(AdbannerPeer::MODIFIED_ON, $modifiedOn['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdbannerPeer::MODIFIED_ON, $modifiedOn, $comparison);
	}

	/**
	 * Filter the query on the modified_by column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByModifiedBy(1234); // WHERE modified_by = 1234
	 * $query->filterByModifiedBy(array(12, 34)); // WHERE modified_by IN (12, 34)
	 * $query->filterByModifiedBy(array('min' => 12)); // WHERE modified_by > 12
	 * </code>
	 *
	 * @param     mixed $modifiedBy The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function filterByModifiedBy($modifiedBy = null, $comparison = null)
	{
		if (is_array($modifiedBy)) {
			$useMinMax = false;
			if (isset($modifiedBy['min'])) {
				$this->addUsingAlias(AdbannerPeer::MODIFIED_BY, $modifiedBy['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($modifiedBy['max'])) {
				$this->addUsingAlias(AdbannerPeer::MODIFIED_BY, $modifiedBy['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdbannerPeer::MODIFIED_BY, $modifiedBy, $comparison);
	}

	/**
	 * Filter the query on the adb_order column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAdbOrder(1234); // WHERE adb_order = 1234
	 * $query->filterByAdbOrder(array(12, 34)); // WHERE adb_order IN (12, 34)
	 * $query->filterByAdbOrder(array('min' => 12)); // WHERE adb_order > 12
	 * </code>
	 *
	 * @param     mixed $adbOrder The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function filterByAdbOrder($adbOrder = null, $comparison = null)
	{
		if (is_array($adbOrder)) {
			$useMinMax = false;
			if (isset($adbOrder['min'])) {
				$this->addUsingAlias(AdbannerPeer::ADB_ORDER, $adbOrder['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($adbOrder['max'])) {
				$this->addUsingAlias(AdbannerPeer::ADB_ORDER, $adbOrder['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdbannerPeer::ADB_ORDER, $adbOrder, $comparison);
	}

	/**
	 * Filter the query on the adb_page column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAdbPage('fooValue');   // WHERE adb_page = 'fooValue'
	 * $query->filterByAdbPage('%fooValue%'); // WHERE adb_page LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $adbPage The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function filterByAdbPage($adbPage = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($adbPage)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $adbPage)) {
				$adbPage = str_replace('*', '%', $adbPage);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AdbannerPeer::ADB_PAGE, $adbPage, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Adbanner $adbanner Object to remove from the list of results
	 *
	 * @return    AdbannerQuery The current query, for fluid interface
	 */
	public function prune($adbanner = null)
	{
		if ($adbanner) {
			$this->addUsingAlias(AdbannerPeer::ADB_ID, $adbanner->getAdbId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseAdbannerQuery