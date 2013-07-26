<?php


/**
 * Base class that represents a query for the 'payout' table.
 *
 * 
 *
 * @method     PayoutQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     PayoutQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     PayoutQuery orderByPaymentInfoId($order = Criteria::ASC) Order by the payment_info_id column
 * @method     PayoutQuery orderByMethod($order = Criteria::ASC) Order by the method column
 * @method     PayoutQuery orderByPtype($order = Criteria::ASC) Order by the ptype column
 * @method     PayoutQuery orderByMoney($order = Criteria::ASC) Order by the money column
 * @method     PayoutQuery orderByBalance($order = Criteria::ASC) Order by the balance column
 * @method     PayoutQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     PayoutQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 * @method     PayoutQuery orderByUserFrom($order = Criteria::ASC) Order by the user_from column
 * @method     PayoutQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method     PayoutQuery groupById() Group by the id column
 * @method     PayoutQuery groupByUserId() Group by the user_id column
 * @method     PayoutQuery groupByPaymentInfoId() Group by the payment_info_id column
 * @method     PayoutQuery groupByMethod() Group by the method column
 * @method     PayoutQuery groupByPtype() Group by the ptype column
 * @method     PayoutQuery groupByMoney() Group by the money column
 * @method     PayoutQuery groupByBalance() Group by the balance column
 * @method     PayoutQuery groupByStatus() Group by the status column
 * @method     PayoutQuery groupByPdate() Group by the pdate column
 * @method     PayoutQuery groupByUserFrom() Group by the user_from column
 * @method     PayoutQuery groupByDescription() Group by the description column
 *
 * @method     PayoutQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PayoutQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PayoutQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     PayoutQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     PayoutQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     PayoutQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     PayoutQuery leftJoinPaymentInfo($relationAlias = null) Adds a LEFT JOIN clause to the query using the PaymentInfo relation
 * @method     PayoutQuery rightJoinPaymentInfo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PaymentInfo relation
 * @method     PayoutQuery innerJoinPaymentInfo($relationAlias = null) Adds a INNER JOIN clause to the query using the PaymentInfo relation
 *
 * @method     Payout findOne(PropelPDO $con = null) Return the first Payout matching the query
 * @method     Payout findOneOrCreate(PropelPDO $con = null) Return the first Payout matching the query, or a new Payout object populated from the query conditions when no match is found
 *
 * @method     Payout findOneById(int $id) Return the first Payout filtered by the id column
 * @method     Payout findOneByUserId(int $user_id) Return the first Payout filtered by the user_id column
 * @method     Payout findOneByPaymentInfoId(int $payment_info_id) Return the first Payout filtered by the payment_info_id column
 * @method     Payout findOneByMethod(int $method) Return the first Payout filtered by the method column
 * @method     Payout findOneByPtype(int $ptype) Return the first Payout filtered by the ptype column
 * @method     Payout findOneByMoney(double $money) Return the first Payout filtered by the money column
 * @method     Payout findOneByBalance(double $balance) Return the first Payout filtered by the balance column
 * @method     Payout findOneByStatus(int $status) Return the first Payout filtered by the status column
 * @method     Payout findOneByPdate(int $pdate) Return the first Payout filtered by the pdate column
 * @method     Payout findOneByUserFrom(int $user_from) Return the first Payout filtered by the user_from column
 * @method     Payout findOneByDescription(string $description) Return the first Payout filtered by the description column
 *
 * @method     array findById(int $id) Return Payout objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return Payout objects filtered by the user_id column
 * @method     array findByPaymentInfoId(int $payment_info_id) Return Payout objects filtered by the payment_info_id column
 * @method     array findByMethod(int $method) Return Payout objects filtered by the method column
 * @method     array findByPtype(int $ptype) Return Payout objects filtered by the ptype column
 * @method     array findByMoney(double $money) Return Payout objects filtered by the money column
 * @method     array findByBalance(double $balance) Return Payout objects filtered by the balance column
 * @method     array findByStatus(int $status) Return Payout objects filtered by the status column
 * @method     array findByPdate(int $pdate) Return Payout objects filtered by the pdate column
 * @method     array findByUserFrom(int $user_from) Return Payout objects filtered by the user_from column
 * @method     array findByDescription(string $description) Return Payout objects filtered by the description column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BasePayoutQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BasePayoutQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Payout', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new PayoutQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    PayoutQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof PayoutQuery) {
			return $criteria;
		}
		$query = new PayoutQuery();
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
	 * @return    Payout|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = PayoutPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(PayoutPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Payout A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `USER_ID`, `PAYMENT_INFO_ID`, `METHOD`, `PTYPE`, `MONEY`, `BALANCE`, `STATUS`, `PDATE`, `USER_FROM`, `DESCRIPTION` FROM `payout` WHERE `ID` = :p0';
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
			$obj = new Payout();
			$obj->hydrate($row);
			PayoutPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    Payout|array|mixed the result, formatted by the current formatter
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
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(PayoutPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(PayoutPeer::ID, $keys, Criteria::IN);
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
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(PayoutPeer::ID, $id, $comparison);
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
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(PayoutPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(PayoutPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PayoutPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the payment_info_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPaymentInfoId(1234); // WHERE payment_info_id = 1234
	 * $query->filterByPaymentInfoId(array(12, 34)); // WHERE payment_info_id IN (12, 34)
	 * $query->filterByPaymentInfoId(array('min' => 12)); // WHERE payment_info_id > 12
	 * </code>
	 *
	 * @see       filterByPaymentInfo()
	 *
	 * @param     mixed $paymentInfoId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function filterByPaymentInfoId($paymentInfoId = null, $comparison = null)
	{
		if (is_array($paymentInfoId)) {
			$useMinMax = false;
			if (isset($paymentInfoId['min'])) {
				$this->addUsingAlias(PayoutPeer::PAYMENT_INFO_ID, $paymentInfoId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($paymentInfoId['max'])) {
				$this->addUsingAlias(PayoutPeer::PAYMENT_INFO_ID, $paymentInfoId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PayoutPeer::PAYMENT_INFO_ID, $paymentInfoId, $comparison);
	}

	/**
	 * Filter the query on the method column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMethod(1234); // WHERE method = 1234
	 * $query->filterByMethod(array(12, 34)); // WHERE method IN (12, 34)
	 * $query->filterByMethod(array('min' => 12)); // WHERE method > 12
	 * </code>
	 *
	 * @param     mixed $method The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function filterByMethod($method = null, $comparison = null)
	{
		if (is_array($method)) {
			$useMinMax = false;
			if (isset($method['min'])) {
				$this->addUsingAlias(PayoutPeer::METHOD, $method['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($method['max'])) {
				$this->addUsingAlias(PayoutPeer::METHOD, $method['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PayoutPeer::METHOD, $method, $comparison);
	}

	/**
	 * Filter the query on the ptype column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPtype(1234); // WHERE ptype = 1234
	 * $query->filterByPtype(array(12, 34)); // WHERE ptype IN (12, 34)
	 * $query->filterByPtype(array('min' => 12)); // WHERE ptype > 12
	 * </code>
	 *
	 * @param     mixed $ptype The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function filterByPtype($ptype = null, $comparison = null)
	{
		if (is_array($ptype)) {
			$useMinMax = false;
			if (isset($ptype['min'])) {
				$this->addUsingAlias(PayoutPeer::PTYPE, $ptype['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($ptype['max'])) {
				$this->addUsingAlias(PayoutPeer::PTYPE, $ptype['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PayoutPeer::PTYPE, $ptype, $comparison);
	}

	/**
	 * Filter the query on the money column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMoney(1234); // WHERE money = 1234
	 * $query->filterByMoney(array(12, 34)); // WHERE money IN (12, 34)
	 * $query->filterByMoney(array('min' => 12)); // WHERE money > 12
	 * </code>
	 *
	 * @param     mixed $money The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function filterByMoney($money = null, $comparison = null)
	{
		if (is_array($money)) {
			$useMinMax = false;
			if (isset($money['min'])) {
				$this->addUsingAlias(PayoutPeer::MONEY, $money['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($money['max'])) {
				$this->addUsingAlias(PayoutPeer::MONEY, $money['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PayoutPeer::MONEY, $money, $comparison);
	}

	/**
	 * Filter the query on the balance column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBalance(1234); // WHERE balance = 1234
	 * $query->filterByBalance(array(12, 34)); // WHERE balance IN (12, 34)
	 * $query->filterByBalance(array('min' => 12)); // WHERE balance > 12
	 * </code>
	 *
	 * @param     mixed $balance The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function filterByBalance($balance = null, $comparison = null)
	{
		if (is_array($balance)) {
			$useMinMax = false;
			if (isset($balance['min'])) {
				$this->addUsingAlias(PayoutPeer::BALANCE, $balance['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($balance['max'])) {
				$this->addUsingAlias(PayoutPeer::BALANCE, $balance['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PayoutPeer::BALANCE, $balance, $comparison);
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
	 * @param     mixed $status The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function filterByStatus($status = null, $comparison = null)
	{
		if (is_array($status)) {
			$useMinMax = false;
			if (isset($status['min'])) {
				$this->addUsingAlias(PayoutPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($status['max'])) {
				$this->addUsingAlias(PayoutPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PayoutPeer::STATUS, $status, $comparison);
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
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function filterByPdate($pdate = null, $comparison = null)
	{
		if (is_array($pdate)) {
			$useMinMax = false;
			if (isset($pdate['min'])) {
				$this->addUsingAlias(PayoutPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($pdate['max'])) {
				$this->addUsingAlias(PayoutPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PayoutPeer::PDATE, $pdate, $comparison);
	}

	/**
	 * Filter the query on the user_from column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUserFrom(1234); // WHERE user_from = 1234
	 * $query->filterByUserFrom(array(12, 34)); // WHERE user_from IN (12, 34)
	 * $query->filterByUserFrom(array('min' => 12)); // WHERE user_from > 12
	 * </code>
	 *
	 * @param     mixed $userFrom The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function filterByUserFrom($userFrom = null, $comparison = null)
	{
		if (is_array($userFrom)) {
			$useMinMax = false;
			if (isset($userFrom['min'])) {
				$this->addUsingAlias(PayoutPeer::USER_FROM, $userFrom['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userFrom['max'])) {
				$this->addUsingAlias(PayoutPeer::USER_FROM, $userFrom['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PayoutPeer::USER_FROM, $userFrom, $comparison);
	}

	/**
	 * Filter the query on the description column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
	 * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $description The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function filterByDescription($description = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($description)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $description)) {
				$description = str_replace('*', '%', $description);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(PayoutPeer::DESCRIPTION, $description, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(PayoutPeer::USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(PayoutPeer::USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    PayoutQuery The current query, for fluid interface
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
	 * Filter the query by a related PaymentInfo object
	 *
	 * @param     PaymentInfo|PropelCollection $paymentInfo The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function filterByPaymentInfo($paymentInfo, $comparison = null)
	{
		if ($paymentInfo instanceof PaymentInfo) {
			return $this
				->addUsingAlias(PayoutPeer::PAYMENT_INFO_ID, $paymentInfo->getId(), $comparison);
		} elseif ($paymentInfo instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(PayoutPeer::PAYMENT_INFO_ID, $paymentInfo->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByPaymentInfo() only accepts arguments of type PaymentInfo or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the PaymentInfo relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function joinPaymentInfo($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('PaymentInfo');

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
			$this->addJoinObject($join, 'PaymentInfo');
		}

		return $this;
	}

	/**
	 * Use the PaymentInfo relation PaymentInfo object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PaymentInfoQuery A secondary query class using the current class as primary query
	 */
	public function usePaymentInfoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinPaymentInfo($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'PaymentInfo', 'PaymentInfoQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Payout $payout Object to remove from the list of results
	 *
	 * @return    PayoutQuery The current query, for fluid interface
	 */
	public function prune($payout = null)
	{
		if ($payout) {
			$this->addUsingAlias(PayoutPeer::ID, $payout->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BasePayoutQuery