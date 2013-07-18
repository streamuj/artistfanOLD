<?php


/**
 * Base class that represents a query for the 'card' table.
 *
 * 
 *
 * @method     CardQuery orderByCardId($order = Criteria::ASC) Order by the card_id column
 * @method     CardQuery orderByCardUserId($order = Criteria::ASC) Order by the card_user_id column
 * @method     CardQuery orderByCardName($order = Criteria::ASC) Order by the card_name column
 * @method     CardQuery orderByCardNumber($order = Criteria::ASC) Order by the card_number column
 * @method     CardQuery orderByCardType($order = Criteria::ASC) Order by the card_type column
 * @method     CardQuery orderByCardExpiry($order = Criteria::ASC) Order by the card_expiry column
 * @method     CardQuery orderByCardCvv($order = Criteria::ASC) Order by the card_cvv column
 * @method     CardQuery orderByCardBillName($order = Criteria::ASC) Order by the card_bill_name column
 * @method     CardQuery orderByCardAddress($order = Criteria::ASC) Order by the card_address column
 * @method     CardQuery orderByCardCity($order = Criteria::ASC) Order by the card_city column
 * @method     CardQuery orderByCardState($order = Criteria::ASC) Order by the card_state column
 * @method     CardQuery orderByCardCountry($order = Criteria::ASC) Order by the card_country column
 * @method     CardQuery orderByCardZip($order = Criteria::ASC) Order by the card_zip column
 * @method     CardQuery orderByCardPhone($order = Criteria::ASC) Order by the card_phone column
 *
 * @method     CardQuery groupByCardId() Group by the card_id column
 * @method     CardQuery groupByCardUserId() Group by the card_user_id column
 * @method     CardQuery groupByCardName() Group by the card_name column
 * @method     CardQuery groupByCardNumber() Group by the card_number column
 * @method     CardQuery groupByCardType() Group by the card_type column
 * @method     CardQuery groupByCardExpiry() Group by the card_expiry column
 * @method     CardQuery groupByCardCvv() Group by the card_cvv column
 * @method     CardQuery groupByCardBillName() Group by the card_bill_name column
 * @method     CardQuery groupByCardAddress() Group by the card_address column
 * @method     CardQuery groupByCardCity() Group by the card_city column
 * @method     CardQuery groupByCardState() Group by the card_state column
 * @method     CardQuery groupByCardCountry() Group by the card_country column
 * @method     CardQuery groupByCardZip() Group by the card_zip column
 * @method     CardQuery groupByCardPhone() Group by the card_phone column
 *
 * @method     CardQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CardQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CardQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     CardQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     CardQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     CardQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     Card findOne(PropelPDO $con = null) Return the first Card matching the query
 * @method     Card findOneOrCreate(PropelPDO $con = null) Return the first Card matching the query, or a new Card object populated from the query conditions when no match is found
 *
 * @method     Card findOneByCardId(int $card_id) Return the first Card filtered by the card_id column
 * @method     Card findOneByCardUserId(int $card_user_id) Return the first Card filtered by the card_user_id column
 * @method     Card findOneByCardName(string $card_name) Return the first Card filtered by the card_name column
 * @method     Card findOneByCardNumber(string $card_number) Return the first Card filtered by the card_number column
 * @method     Card findOneByCardType(string $card_type) Return the first Card filtered by the card_type column
 * @method     Card findOneByCardExpiry(string $card_expiry) Return the first Card filtered by the card_expiry column
 * @method     Card findOneByCardCvv(string $card_cvv) Return the first Card filtered by the card_cvv column
 * @method     Card findOneByCardBillName(string $card_bill_name) Return the first Card filtered by the card_bill_name column
 * @method     Card findOneByCardAddress(string $card_address) Return the first Card filtered by the card_address column
 * @method     Card findOneByCardCity(string $card_city) Return the first Card filtered by the card_city column
 * @method     Card findOneByCardState(string $card_state) Return the first Card filtered by the card_state column
 * @method     Card findOneByCardCountry(string $card_country) Return the first Card filtered by the card_country column
 * @method     Card findOneByCardZip(string $card_zip) Return the first Card filtered by the card_zip column
 * @method     Card findOneByCardPhone(string $card_phone) Return the first Card filtered by the card_phone column
 *
 * @method     array findByCardId(int $card_id) Return Card objects filtered by the card_id column
 * @method     array findByCardUserId(int $card_user_id) Return Card objects filtered by the card_user_id column
 * @method     array findByCardName(string $card_name) Return Card objects filtered by the card_name column
 * @method     array findByCardNumber(string $card_number) Return Card objects filtered by the card_number column
 * @method     array findByCardType(string $card_type) Return Card objects filtered by the card_type column
 * @method     array findByCardExpiry(string $card_expiry) Return Card objects filtered by the card_expiry column
 * @method     array findByCardCvv(string $card_cvv) Return Card objects filtered by the card_cvv column
 * @method     array findByCardBillName(string $card_bill_name) Return Card objects filtered by the card_bill_name column
 * @method     array findByCardAddress(string $card_address) Return Card objects filtered by the card_address column
 * @method     array findByCardCity(string $card_city) Return Card objects filtered by the card_city column
 * @method     array findByCardState(string $card_state) Return Card objects filtered by the card_state column
 * @method     array findByCardCountry(string $card_country) Return Card objects filtered by the card_country column
 * @method     array findByCardZip(string $card_zip) Return Card objects filtered by the card_zip column
 * @method     array findByCardPhone(string $card_phone) Return Card objects filtered by the card_phone column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseCardQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseCardQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Card', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CardQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CardQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CardQuery) {
			return $criteria;
		}
		$query = new CardQuery();
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
	 * @return    Card|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = CardPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(CardPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Card A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `CARD_ID`, `CARD_USER_ID`, `CARD_NAME`, `CARD_NUMBER`, `CARD_TYPE`, `CARD_EXPIRY`, `CARD_CVV`, `CARD_BILL_NAME`, `CARD_ADDRESS`, `CARD_CITY`, `CARD_STATE`, `CARD_COUNTRY`, `CARD_ZIP`, `CARD_PHONE` FROM `card` WHERE `CARD_ID` = :p0';
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
			$obj = new Card();
			$obj->hydrate($row);
			CardPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    Card|array|mixed the result, formatted by the current formatter
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
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(CardPeer::CARD_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(CardPeer::CARD_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the card_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCardId(1234); // WHERE card_id = 1234
	 * $query->filterByCardId(array(12, 34)); // WHERE card_id IN (12, 34)
	 * $query->filterByCardId(array('min' => 12)); // WHERE card_id > 12
	 * </code>
	 *
	 * @param     mixed $cardId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByCardId($cardId = null, $comparison = null)
	{
		if (is_array($cardId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(CardPeer::CARD_ID, $cardId, $comparison);
	}

	/**
	 * Filter the query on the card_user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCardUserId(1234); // WHERE card_user_id = 1234
	 * $query->filterByCardUserId(array(12, 34)); // WHERE card_user_id IN (12, 34)
	 * $query->filterByCardUserId(array('min' => 12)); // WHERE card_user_id > 12
	 * </code>
	 *
	 * @see       filterByUser()
	 *
	 * @param     mixed $cardUserId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByCardUserId($cardUserId = null, $comparison = null)
	{
		if (is_array($cardUserId)) {
			$useMinMax = false;
			if (isset($cardUserId['min'])) {
				$this->addUsingAlias(CardPeer::CARD_USER_ID, $cardUserId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($cardUserId['max'])) {
				$this->addUsingAlias(CardPeer::CARD_USER_ID, $cardUserId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CardPeer::CARD_USER_ID, $cardUserId, $comparison);
	}

	/**
	 * Filter the query on the card_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCardName('fooValue');   // WHERE card_name = 'fooValue'
	 * $query->filterByCardName('%fooValue%'); // WHERE card_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $cardName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByCardName($cardName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cardName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cardName)) {
				$cardName = str_replace('*', '%', $cardName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardPeer::CARD_NAME, $cardName, $comparison);
	}

	/**
	 * Filter the query on the card_number column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCardNumber('fooValue');   // WHERE card_number = 'fooValue'
	 * $query->filterByCardNumber('%fooValue%'); // WHERE card_number LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $cardNumber The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByCardNumber($cardNumber = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cardNumber)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cardNumber)) {
				$cardNumber = str_replace('*', '%', $cardNumber);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardPeer::CARD_NUMBER, $cardNumber, $comparison);
	}

	/**
	 * Filter the query on the card_type column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCardType('fooValue');   // WHERE card_type = 'fooValue'
	 * $query->filterByCardType('%fooValue%'); // WHERE card_type LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $cardType The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByCardType($cardType = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cardType)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cardType)) {
				$cardType = str_replace('*', '%', $cardType);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardPeer::CARD_TYPE, $cardType, $comparison);
	}

	/**
	 * Filter the query on the card_expiry column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCardExpiry('fooValue');   // WHERE card_expiry = 'fooValue'
	 * $query->filterByCardExpiry('%fooValue%'); // WHERE card_expiry LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $cardExpiry The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByCardExpiry($cardExpiry = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cardExpiry)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cardExpiry)) {
				$cardExpiry = str_replace('*', '%', $cardExpiry);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardPeer::CARD_EXPIRY, $cardExpiry, $comparison);
	}

	/**
	 * Filter the query on the card_cvv column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCardCvv('fooValue');   // WHERE card_cvv = 'fooValue'
	 * $query->filterByCardCvv('%fooValue%'); // WHERE card_cvv LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $cardCvv The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByCardCvv($cardCvv = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cardCvv)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cardCvv)) {
				$cardCvv = str_replace('*', '%', $cardCvv);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardPeer::CARD_CVV, $cardCvv, $comparison);
	}

	/**
	 * Filter the query on the card_bill_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCardBillName('fooValue');   // WHERE card_bill_name = 'fooValue'
	 * $query->filterByCardBillName('%fooValue%'); // WHERE card_bill_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $cardBillName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByCardBillName($cardBillName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cardBillName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cardBillName)) {
				$cardBillName = str_replace('*', '%', $cardBillName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardPeer::CARD_BILL_NAME, $cardBillName, $comparison);
	}

	/**
	 * Filter the query on the card_address column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCardAddress('fooValue');   // WHERE card_address = 'fooValue'
	 * $query->filterByCardAddress('%fooValue%'); // WHERE card_address LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $cardAddress The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByCardAddress($cardAddress = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cardAddress)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cardAddress)) {
				$cardAddress = str_replace('*', '%', $cardAddress);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardPeer::CARD_ADDRESS, $cardAddress, $comparison);
	}

	/**
	 * Filter the query on the card_city column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCardCity('fooValue');   // WHERE card_city = 'fooValue'
	 * $query->filterByCardCity('%fooValue%'); // WHERE card_city LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $cardCity The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByCardCity($cardCity = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cardCity)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cardCity)) {
				$cardCity = str_replace('*', '%', $cardCity);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardPeer::CARD_CITY, $cardCity, $comparison);
	}

	/**
	 * Filter the query on the card_state column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCardState('fooValue');   // WHERE card_state = 'fooValue'
	 * $query->filterByCardState('%fooValue%'); // WHERE card_state LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $cardState The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByCardState($cardState = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cardState)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cardState)) {
				$cardState = str_replace('*', '%', $cardState);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardPeer::CARD_STATE, $cardState, $comparison);
	}

	/**
	 * Filter the query on the card_country column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCardCountry('fooValue');   // WHERE card_country = 'fooValue'
	 * $query->filterByCardCountry('%fooValue%'); // WHERE card_country LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $cardCountry The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByCardCountry($cardCountry = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cardCountry)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cardCountry)) {
				$cardCountry = str_replace('*', '%', $cardCountry);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardPeer::CARD_COUNTRY, $cardCountry, $comparison);
	}

	/**
	 * Filter the query on the card_zip column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCardZip('fooValue');   // WHERE card_zip = 'fooValue'
	 * $query->filterByCardZip('%fooValue%'); // WHERE card_zip LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $cardZip The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByCardZip($cardZip = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cardZip)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cardZip)) {
				$cardZip = str_replace('*', '%', $cardZip);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardPeer::CARD_ZIP, $cardZip, $comparison);
	}

	/**
	 * Filter the query on the card_phone column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCardPhone('fooValue');   // WHERE card_phone = 'fooValue'
	 * $query->filterByCardPhone('%fooValue%'); // WHERE card_phone LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $cardPhone The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByCardPhone($cardPhone = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($cardPhone)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $cardPhone)) {
				$cardPhone = str_replace('*', '%', $cardPhone);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CardPeer::CARD_PHONE, $cardPhone, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(CardPeer::CARD_USER_ID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(CardPeer::CARD_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
	public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'User', 'UserQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Card $card Object to remove from the list of results
	 *
	 * @return    CardQuery The current query, for fluid interface
	 */
	public function prune($card = null)
	{
		if ($card) {
			$this->addUsingAlias(CardPeer::CARD_ID, $card->getCardId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseCardQuery