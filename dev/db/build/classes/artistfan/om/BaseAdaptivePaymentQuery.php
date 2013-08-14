<?php


/**
 * Base class that represents a query for the 'adaptive_payment' table.
 *
 * 
 *
 * @method     AdaptivePaymentQuery orderByApId($order = Criteria::ASC) Order by the ap_id column
 * @method     AdaptivePaymentQuery orderByApSenderEmail($order = Criteria::ASC) Order by the ap_sender_email column
 * @method     AdaptivePaymentQuery orderByApApprovalKey($order = Criteria::ASC) Order by the ap_approval_key column
 * @method     AdaptivePaymentQuery orderByApFromDate($order = Criteria::ASC) Order by the ap_from_date column
 * @method     AdaptivePaymentQuery orderByApToDate($order = Criteria::ASC) Order by the ap_to_date column
 * @method     AdaptivePaymentQuery orderByApMaxAmount($order = Criteria::ASC) Order by the ap_max_amount column
 * @method     AdaptivePaymentQuery orderByApDate($order = Criteria::ASC) Order by the ap_date column
 * @method     AdaptivePaymentQuery orderByApStatus($order = Criteria::ASC) Order by the ap_status column
 *
 * @method     AdaptivePaymentQuery groupByApId() Group by the ap_id column
 * @method     AdaptivePaymentQuery groupByApSenderEmail() Group by the ap_sender_email column
 * @method     AdaptivePaymentQuery groupByApApprovalKey() Group by the ap_approval_key column
 * @method     AdaptivePaymentQuery groupByApFromDate() Group by the ap_from_date column
 * @method     AdaptivePaymentQuery groupByApToDate() Group by the ap_to_date column
 * @method     AdaptivePaymentQuery groupByApMaxAmount() Group by the ap_max_amount column
 * @method     AdaptivePaymentQuery groupByApDate() Group by the ap_date column
 * @method     AdaptivePaymentQuery groupByApStatus() Group by the ap_status column
 *
 * @method     AdaptivePaymentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     AdaptivePaymentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     AdaptivePaymentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     AdaptivePayment findOne(PropelPDO $con = null) Return the first AdaptivePayment matching the query
 * @method     AdaptivePayment findOneOrCreate(PropelPDO $con = null) Return the first AdaptivePayment matching the query, or a new AdaptivePayment object populated from the query conditions when no match is found
 *
 * @method     AdaptivePayment findOneByApId(int $ap_id) Return the first AdaptivePayment filtered by the ap_id column
 * @method     AdaptivePayment findOneByApSenderEmail(string $ap_sender_email) Return the first AdaptivePayment filtered by the ap_sender_email column
 * @method     AdaptivePayment findOneByApApprovalKey(string $ap_approval_key) Return the first AdaptivePayment filtered by the ap_approval_key column
 * @method     AdaptivePayment findOneByApFromDate(string $ap_from_date) Return the first AdaptivePayment filtered by the ap_from_date column
 * @method     AdaptivePayment findOneByApToDate(string $ap_to_date) Return the first AdaptivePayment filtered by the ap_to_date column
 * @method     AdaptivePayment findOneByApMaxAmount(string $ap_max_amount) Return the first AdaptivePayment filtered by the ap_max_amount column
 * @method     AdaptivePayment findOneByApDate(int $ap_date) Return the first AdaptivePayment filtered by the ap_date column
 * @method     AdaptivePayment findOneByApStatus(int $ap_status) Return the first AdaptivePayment filtered by the ap_status column
 *
 * @method     array findByApId(int $ap_id) Return AdaptivePayment objects filtered by the ap_id column
 * @method     array findByApSenderEmail(string $ap_sender_email) Return AdaptivePayment objects filtered by the ap_sender_email column
 * @method     array findByApApprovalKey(string $ap_approval_key) Return AdaptivePayment objects filtered by the ap_approval_key column
 * @method     array findByApFromDate(string $ap_from_date) Return AdaptivePayment objects filtered by the ap_from_date column
 * @method     array findByApToDate(string $ap_to_date) Return AdaptivePayment objects filtered by the ap_to_date column
 * @method     array findByApMaxAmount(string $ap_max_amount) Return AdaptivePayment objects filtered by the ap_max_amount column
 * @method     array findByApDate(int $ap_date) Return AdaptivePayment objects filtered by the ap_date column
 * @method     array findByApStatus(int $ap_status) Return AdaptivePayment objects filtered by the ap_status column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseAdaptivePaymentQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseAdaptivePaymentQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'AdaptivePayment', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new AdaptivePaymentQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AdaptivePaymentQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AdaptivePaymentQuery) {
			return $criteria;
		}
		$query = new AdaptivePaymentQuery();
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
	 * @return    AdaptivePayment|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = AdaptivePaymentPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(AdaptivePaymentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    AdaptivePayment A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `AP_ID`, `AP_SENDER_EMAIL`, `AP_APPROVAL_KEY`, `AP_FROM_DATE`, `AP_TO_DATE`, `AP_MAX_AMOUNT`, `AP_DATE`, `AP_STATUS` FROM `adaptive_payment` WHERE `AP_ID` = :p0';
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
			$obj = new AdaptivePayment();
			$obj->hydrate($row);
			AdaptivePaymentPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    AdaptivePayment|array|mixed the result, formatted by the current formatter
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
	 * @return    AdaptivePaymentQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(AdaptivePaymentPeer::AP_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    AdaptivePaymentQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(AdaptivePaymentPeer::AP_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the ap_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByApId(1234); // WHERE ap_id = 1234
	 * $query->filterByApId(array(12, 34)); // WHERE ap_id IN (12, 34)
	 * $query->filterByApId(array('min' => 12)); // WHERE ap_id > 12
	 * </code>
	 *
	 * @param     mixed $apId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdaptivePaymentQuery The current query, for fluid interface
	 */
	public function filterByApId($apId = null, $comparison = null)
	{
		if (is_array($apId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AdaptivePaymentPeer::AP_ID, $apId, $comparison);
	}

	/**
	 * Filter the query on the ap_sender_email column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByApSenderEmail('fooValue');   // WHERE ap_sender_email = 'fooValue'
	 * $query->filterByApSenderEmail('%fooValue%'); // WHERE ap_sender_email LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $apSenderEmail The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdaptivePaymentQuery The current query, for fluid interface
	 */
	public function filterByApSenderEmail($apSenderEmail = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($apSenderEmail)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $apSenderEmail)) {
				$apSenderEmail = str_replace('*', '%', $apSenderEmail);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AdaptivePaymentPeer::AP_SENDER_EMAIL, $apSenderEmail, $comparison);
	}

	/**
	 * Filter the query on the ap_approval_key column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByApApprovalKey('fooValue');   // WHERE ap_approval_key = 'fooValue'
	 * $query->filterByApApprovalKey('%fooValue%'); // WHERE ap_approval_key LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $apApprovalKey The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdaptivePaymentQuery The current query, for fluid interface
	 */
	public function filterByApApprovalKey($apApprovalKey = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($apApprovalKey)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $apApprovalKey)) {
				$apApprovalKey = str_replace('*', '%', $apApprovalKey);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AdaptivePaymentPeer::AP_APPROVAL_KEY, $apApprovalKey, $comparison);
	}

	/**
	 * Filter the query on the ap_from_date column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByApFromDate('fooValue');   // WHERE ap_from_date = 'fooValue'
	 * $query->filterByApFromDate('%fooValue%'); // WHERE ap_from_date LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $apFromDate The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdaptivePaymentQuery The current query, for fluid interface
	 */
	public function filterByApFromDate($apFromDate = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($apFromDate)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $apFromDate)) {
				$apFromDate = str_replace('*', '%', $apFromDate);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AdaptivePaymentPeer::AP_FROM_DATE, $apFromDate, $comparison);
	}

	/**
	 * Filter the query on the ap_to_date column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByApToDate('fooValue');   // WHERE ap_to_date = 'fooValue'
	 * $query->filterByApToDate('%fooValue%'); // WHERE ap_to_date LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $apToDate The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdaptivePaymentQuery The current query, for fluid interface
	 */
	public function filterByApToDate($apToDate = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($apToDate)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $apToDate)) {
				$apToDate = str_replace('*', '%', $apToDate);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AdaptivePaymentPeer::AP_TO_DATE, $apToDate, $comparison);
	}

	/**
	 * Filter the query on the ap_max_amount column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByApMaxAmount('fooValue');   // WHERE ap_max_amount = 'fooValue'
	 * $query->filterByApMaxAmount('%fooValue%'); // WHERE ap_max_amount LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $apMaxAmount The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdaptivePaymentQuery The current query, for fluid interface
	 */
	public function filterByApMaxAmount($apMaxAmount = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($apMaxAmount)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $apMaxAmount)) {
				$apMaxAmount = str_replace('*', '%', $apMaxAmount);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AdaptivePaymentPeer::AP_MAX_AMOUNT, $apMaxAmount, $comparison);
	}

	/**
	 * Filter the query on the ap_date column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByApDate(1234); // WHERE ap_date = 1234
	 * $query->filterByApDate(array(12, 34)); // WHERE ap_date IN (12, 34)
	 * $query->filterByApDate(array('min' => 12)); // WHERE ap_date > 12
	 * </code>
	 *
	 * @param     mixed $apDate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdaptivePaymentQuery The current query, for fluid interface
	 */
	public function filterByApDate($apDate = null, $comparison = null)
	{
		if (is_array($apDate)) {
			$useMinMax = false;
			if (isset($apDate['min'])) {
				$this->addUsingAlias(AdaptivePaymentPeer::AP_DATE, $apDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($apDate['max'])) {
				$this->addUsingAlias(AdaptivePaymentPeer::AP_DATE, $apDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdaptivePaymentPeer::AP_DATE, $apDate, $comparison);
	}

	/**
	 * Filter the query on the ap_status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByApStatus(1234); // WHERE ap_status = 1234
	 * $query->filterByApStatus(array(12, 34)); // WHERE ap_status IN (12, 34)
	 * $query->filterByApStatus(array('min' => 12)); // WHERE ap_status > 12
	 * </code>
	 *
	 * @param     mixed $apStatus The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AdaptivePaymentQuery The current query, for fluid interface
	 */
	public function filterByApStatus($apStatus = null, $comparison = null)
	{
		if (is_array($apStatus)) {
			$useMinMax = false;
			if (isset($apStatus['min'])) {
				$this->addUsingAlias(AdaptivePaymentPeer::AP_STATUS, $apStatus['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($apStatus['max'])) {
				$this->addUsingAlias(AdaptivePaymentPeer::AP_STATUS, $apStatus['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AdaptivePaymentPeer::AP_STATUS, $apStatus, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     AdaptivePayment $adaptivePayment Object to remove from the list of results
	 *
	 * @return    AdaptivePaymentQuery The current query, for fluid interface
	 */
	public function prune($adaptivePayment = null)
	{
		if ($adaptivePayment) {
			$this->addUsingAlias(AdaptivePaymentPeer::AP_ID, $adaptivePayment->getApId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseAdaptivePaymentQuery